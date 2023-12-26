import base64
import datetime
import secrets

from flask import Flask, jsonify, request

from utils.configuration.mysql import MySQL
from utils.configuration.variables import User

app = Flask(__name__)


def add_user(user, password, plan, vip, api=None):
    """
    Add a new user to the database.

    :param user: str, the username of the new user.
    :param password: str, the password of the new user.
    :param plan: str, the plan of the new user.
    :param vip: bool, whether the new user is a VIP user or not.
    :param api: str, the API key of the new user.
    """
    key = secrets.token_hex(32)
    if api == "1":
        api = key
    rank = 'user'
    date_actuelle = datetime.date.today()
    duration = date_actuelle + datetime.timedelta(days=30)
    passwd = password
    encoded_key = base64.b64encode(passwd.encode()).decode()

    sql = "INSERT INTO users (user, password, plan, vip, api, duration, rank, 2factive, 2facode) VALUES (%s, %s, %s, %s, %s, %s, %s , %s, %s)"
    MySQL().execute_insert(sql, (user, encoded_key, plan, vip, api, duration, "user" , "0", "0"))


def remove_user(user_id):
    """
    Remove a user from the database.

    :param user_id: int, the ID of the user to remove.
    """
    sql = "DELETE FROM users WHERE id=%s"
    MySQL().execute_update(sql, (user_id,))


@app.route('/subscribe', methods=['POST'])
def subscribe():
    """
    Subscribe a new user.

    :return: JSON object, a message indicating the subscription was successful.
    """
    # Get subscription information from the request
    data = request.get_json()
    user = data['user']
    password = data['password']
    plan = data['plan']
    vip = data['vip']

    # Add the user to the database
    add_user(user, password, plan, vip)

    return jsonify({'message': 'Successfully subscribed!'})


@app.route('/unsubscribe', methods=['POST'])
def unsubscribe():
    """
    Unsubscribe a user.

    :return: JSON object, a message indicating the unsubscription was successful.
    """
    data = request.get_json()
    user_id = data['user_id']

    # Remove the user from the database
    remove_user(user_id)

    return jsonify({'message': 'Successfully unsubscribed!'})


def reset_subscriptions():
    """
    Reset all subscriptions to the free plan and non-VIP status.
    """
    sql = "UPDATE users SET plan=%s, vip=%s"
    MySQL().execute_update(sql, ("free", False))


def delete_expired_subscriptions():
    """
    Delete all expired subscriptions from the database.
    """
    try:

        # Get the current time
        now = datetime.date.today()

        # Get user data from the 'users' table
        sql = 'SELECT id, user, plan, duration FROM users'
        cursor = MySQL().execute(sql)

        # Create a temporary list of users to delete
        to_delete = []

        # Iterate over users
        for user_data in cursor:
            if user_data['duration'] is not None and user_data['duration'] < now:
                to_delete.append(user_data['id'])

        # Delete users to delete
        for id in to_delete:
            MySQL().execute('DELETE FROM users WHERE id = %s', (id,))

    except Exception as e:
        print(f"Error connecting to the database: {e}")


def check_plan(username):
    """
    Check the plan of a user.

    :param username: str, the username of the user to check.
    :return: bool, whether the user is on the free plan or not.
    """
    plan_user = User(username=username).get_plan_by_username()
    input(plan_user)
    if plan_user[0] == "free":
        print("""
        ┌─────────────────� SILENCE �─────────────────┐
        │         USER BLOCKED BUY FOR ACCES          │
        └─────────────────────────────────────────────┘
        """)
        pass
    else:
        return False
    
