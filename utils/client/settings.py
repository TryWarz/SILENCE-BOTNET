from colorama import Fore as F
from utils.configuration.variables import *
from utils.plugin.variables import *

class Settings:
    def __init__(self):
        pass

    def settings(self):
        print(f"""{F.RED}
              
                      ╔═╗╦╦  ╔═╗╔╗╔╔═╗╔═╗
                      ╚═╗║║  ║╣ ║║║║  ║╣ 
                      ╚═╝╩╩═╝╚═╝╝╚╝╚═╝╚═╝
        ╚══════╦════════════════════════════════╦══════╝
   ╔═══════════╩═══{F.RESET}[https://t.me/silencearmy]{F.RED}═══╩═══════════╗                      
   ╚╔═╗―――――――――――――――――――――――――――――――――――――――――――――――――――――╝           
    ║I║ {F.RED}🚀{F.RESET} NAME : {F.GREEN}{get_user()}{F.RED}
    ║N║ {F.RED}🚀{F.RESET} PLAN : {F.GREEN}{User(username=get_user()).get_plan_by_username()[0]}{F.RED}
    ║F║ {F.RED}🚀{F.RESET} EXPIRE : {F.GREEN}{User(username=get_user()).get_expiration_by_username()[0][0]}{F.RED}
    ║O║ {F.RED}🚀{F.RESET} 2FA : {F.GREEN}{User(username=get_user()).get_2fa_by_username()[0]}{F.RED}
    ║#║ {F.RED}🚀{F.RESET} 2FA CODE : {F.GREEN}{User(username=get_user()).get_2fcode_by_username()[0][0]}{F.RED}
   ╔╚═╝―――――――――――――――――――――――――――――――――――――――――――――――――――――╗                                                       
   ╚════════════════════════════════════════════════════════╝           
              """)   
