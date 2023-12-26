import psutil, datetime
from colorama import Fore as F

class UPTIME:
    def __init__(self):
        pass

    def get_ram(self):
        ram = psutil.virtual_memory().total / (1024.**2)

        return ram
    
    def get_up_time(self):
        uptime = datetime.timedelta(seconds=psutil.boot_time())
        hours, remainder = divmod(uptime.seconds, 3600)
        minutes, seconds = divmod(remainder, 60)
        return "{} hours {} minutes {} seconds".format(hours, minutes, seconds)

    def get_cpu_name(self):
        return str(psutil.cpu_freq().current) + F.RESET + " Mhz"
    
    def get_cpu_usage(self):
        return str(psutil.cpu_percent()) + F.RESET +"%"
    
    def get_ram_usage(self):
        return str(psutil.virtual_memory().percent) + F.RESET +"%"
    
    def get_disk_usage(self):
        return str(psutil.disk_usage('/').percent) + F.RESET + "%"
    
    def get_disk_total(self):
        return str(psutil.disk_usage('/').total / (1024.**3)) + F.RESET + " GB"
        
    def main(self):
        disk_total = self.get_disk_total() 
        disk_usage = self.get_disk_usage()
        ram_usage = self.get_ram_usage()
        cpu_usage = self.get_cpu_usage()
        cpu_name = self.get_cpu_name()
        ram = self.get_ram()
        uptime = self.get_up_time()
        print(f"""{F.RED}
              
                      ╔═╗╦╦  ╔═╗╔╗╔╔═╗╔═╗
                      ╚═╗║║  ║╣ ║║║║  ║╣ 
                      ╚═╝╩╩═╝╚═╝╝╚╝╚═╝╚═╝
        ╚══════╦════════════════════════════════╦══════╝
   ╔═══════════╩═══{F.RESET}[https://t.me/silencearmy]{F.RED}═══╩═══════════╗                      
   ╚╔═╗―――――――――――――――――――――――――――――――――――――――――――――――――――――╝           
    ║#║ {F.RED} UPTIME : {F.GREEN}{uptime}{F.RED}
    ║#║ 
    ║U║ {F.RED} DISK TOTAL : {F.GREEN}{disk_total}{F.RED}
    ║P║ {F.RED} DISK USAGE : {F.GREEN}{disk_usage}{F.RED}
    ║T║ 
    ║I║ {F.RED} RAM TOTAL : {F.GREEN}{ram}{F.RESET} MB {F.RED}
    ║M║ {F.RED} RAM USAGE : {F.GREEN}{ram_usage}{F.RESET} MB {F.RED}
    ║E║
    ║#║ {F.RED} CPU NAME : {F.GREEN}{cpu_name}{F.RED}
    ║#║ {F.RED} CPU USAGE : {F.GREEN}{cpu_usage}{F.RED}
   ╔╚═╝―――――――――――――――――――――――――――――――――――――――――――――――――――――╗                                                       
   ╚════════════════════════════════════════════════════════╝           
              """)   