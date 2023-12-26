from utils.configuration.mysql import *
from colorama import Fore as F



def get_ip_tracker_all():
        query = "SELECT * FROM ip_tracker"
        result = MySQL().execute(query)

        output = f"""{F.RED}                      
                      ╔═╗╦╦  ╔═╗╔╗╔╔═╗╔═╗
                      ╚═╗║║  ║╣ ║║║║  ║╣ 
                      ╚═╝╩╩═╝╚═╝╝╚╝╚═╝╚═╝
        ╚══════╦════════════════════════════════╦══════╝
   ╔═══════════╩═══{F.RESET}[https://t.me/silencearmy]{F.RED}═══╩═══════════╗                      
   ╚╔═╗―――――――――――――――――――――――――――――――――――――――――――――――――――――╝     """
        for row in result:
            output += f"\n    ║{F.RESET}#{F.RED}║  {F.RESET}" + row[1] + f"{F.RED} -> {F.RESET}" + row[2] + f"{F.RED}"
        output += f"""{F.RED}   
   ╔╚═╝―――――――――――――――――――――――――――――――――――――――――――――――――――――╗                                                       
   ╚════════════════════════════════════════════════════════╝"""
        return output
    
    

    