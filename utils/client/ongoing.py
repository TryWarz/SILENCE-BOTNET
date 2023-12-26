import getpass, pymysql, requests, socket
from utils.plugin.commun import Color, gradient_print, Color
from utils.plugin.variables import get_user, cls as clear
from utils.configuration.mysql import MySQL
from colorama import Fore as F


username = get_user()

def ongoing():

    # Récupérer l'utilisateur actuel
    sql = f"SELECT host, port, time, methods, end FROM logs WHERE user = '{username}'"
    result = MySQL().execute_one(sql)


    if result is not None:
        host = result[0]
        port = result[1]
        time = result[2]
        method = result[3]
        end = result[4]
    else:
        host = "None"
        port = "None"
        time = "None"
        method = "None"
        end = "None"
    

    if host.startswith("http://") or host.startswith("https://"):
        try:
            response = requests.get(host)
            if response.status_code == 200:
                message = f"{F.GREEN}Ready"
            else:
                message = f"{F.RED}Down"
        except requests.ConnectionError:
            message = f"{F.RED}Down"
    else:

        # Vérification de l'adresse IP
        try:
            socket.create_connection((host, port), timeout=2)
            message = f"{F.GREEN}Ready"
        except socket.error:
            message = f"{F.RED}Down"
    clear()
    gradient_print(f"""
                              ╔═╗╦╦  ╔═╗╔╗╔╔═╗╔═╗
                              ╚═╗║║  ║╣ ║║║║  ║╣ 
                              ╚═╝╩╩═╝╚═╝╝╚╝╚═╝╚═╝""",start_color=Color.red, end_color=Color.white_smoke)
    print(f"""                             {F.RED}SERVER STATUS [{message}{F.RED}]{F.RESET} 🚀{F.LIGHTBLACK_EX}
                    ══╦═════════════════════════════════╦══
            ╔═════════╩═════════════════════════════════╩═════════╗
            ║  {F.RESET}Target {F.RED}> {F.LIGHTBLACK_EX}[{F.RED}{host}{F.LIGHTBLACK_EX}]
            ║  {F.RESET}Port {F.RED}> {F.LIGHTBLACK_EX}[{F.RED}{port}{F.LIGHTBLACK_EX}]
            ║  {F.RESET}Time {F.RED}> {F.LIGHTBLACK_EX}[{F.RED}{time}{F.LIGHTBLACK_EX}]
            ║  {F.RESET}Method {F.RED}> {F.LIGHTBLACK_EX}[{F.RED}{method}{F.LIGHTBLACK_EX}]
            ║  {F.RESET}END {F.RED}> {F.LIGHTBLACK_EX}[{F.RED}{end}{F.LIGHTBLACK_EX}]
            ╚═════════════════════════════════════════════════════╝
            
            
            """)