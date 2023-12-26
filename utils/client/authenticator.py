import pyotp
from utils.configuration.configuration import *
from utils.configuration.mysql import *
from utils.plugin.variables import *

class Authenticator:
    def __init__(self, onoff=None):
        self.onoff = onoff
       

    def active(self):
        mydb = pymysql.connect(
            host=DB_HOST,
            user=DB_USER,
            password=DB_PASSWORD,
            database=DB_NAME
        )
        try:
            with mydb.cursor() as mycursor:
                if self.onoff == "1":
                    # Generate a new secret and provisioning URI for 2FA
                    secret = pyotp.random_base32()
                    print(f"Your 2FA secret is: {secret}")
                    uri = pyotp.totp.TOTP(secret).provisioning_uri(get_user(), issuer_name="Silence")
                    sql = "UPDATE users SET 2factive = %s, 2fcode = %s WHERE user = %s"
                    mycursor.execute(sql, ("1", secret, get_user()))
                elif self.onoff == "0":
                    secret = None
                    sql = "UPDATE users SET 2factive = %s, 2fcode = %s WHERE user = %s"
                    mycursor.execute(sql, ("0", secret, get_user()))
                else:
                    print('ERROR')
                    return

            mydb.commit()
        except Exception as e:
            print(f"An error occurred: {e}")
        finally:
            mydb.close()
        
    def verify(self):
        code = input("Enter your 2FA code: ")
        mydb = pymysql.connect(
            host=DB_HOST,
            user=DB_USER,
            password=DB_PASSWORD,
            database=DB_NAME
        )
        try:
            with mydb.cursor() as mycursor:
                sql = "SELECT 2fcode FROM users WHERE user = %s"
                mycursor.execute(sql, (get_user()))
                result = mycursor.fetchone()
                if result is not None:
                    secret = result[0]
                    if secret is not None:
                        if pyotp.TOTP(secret).verify(code):
                            return True
                        else:
                            return False
                    else:
                        return True
                else:
                    return True
        except Exception as e:
            print(f"An error occurred: {e}")
        finally:
            mydb.close()