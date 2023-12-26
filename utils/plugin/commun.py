from rgbprint import gradient_print, Color
from colorama import Fore as F


class ConfigurationsTheme:
    def __init__(self, banner=None, color1=None, color2=None):
        self.banner = banner
        self.color1 = color1
        self.color2 = color2

    def home(self):
        print(f"""
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀{F.RED}⢤⣶⣄⠀{F.RESET}⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀{F.RED}⣀⣤⡾⠿⢿⡀{F.RESET}⠀⠀⠀⠀⣠⣶⣿⣷⠀⠀⠀⠀
⠀⠀⠀⠀⠀⠀⠀⠀{F.RED}⢀⣴⣦⣴⣿⡋⠀⠀⠈⢳⡄{F.RESET}⠀⢠⣾⣿⠁⠈⣿⡆⠀⠀⠀      SILENCE NETWORK [Online]
⠀⠀⠀⠀⠀⠀⠀{F.RED}⣰⣿⣿⠿⠛⠉⠉⠁⠀⠀⠀⠹⡄{F.RESET}⣿⣿⣿⠀⠀⢹⡇⠀⠀⠀  Type "help" for more information
⠀⠀⠀⠀⠀{F.RED}⣠⣾⡿⠋⠁{F.RESET}⠀⠀⠀⠀⠀⠀⠀⠀⣰⣏⢻⣿⣿⡆⠀⠸⣿⠀⠀⠀Powered by : https://t.me/silencearmy
⠀⠀⠀{F.RED}⢀⣴⠟⠁{F.RESET}⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⣾⣿⣿⣆⠹⣿⣷⠀⢘⣿⠀⠀⠀
⠀⠀{F.RED}⢀⡾⠁{F.RESET}⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢰⣿⣿⠋⠉⠛⠂⠹⠿⣲⣿⣿⣧⠀⠀
⠀{F.RED}⢠⠏{F.RESET}⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢀⣤⣿⣿⣿⣷⣾⣿⡇⢀⠀⣼⣿⣿⣿⣧⠀
{F.RED}⠰⠃{F.RESET}⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⢠⣾⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⡘⢿⣿⣿⣿⠀
{F.RED}⠁{F.RESET}⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠀⠸⣿⣿⣿⣿⣿⣿⣿⣿⣿⣿⠀⣷⡈⠿⢿⣿⡆
             ⠙⠛⠁⢙⠛⣿⣿⣿⣿⡟⠀⡿⠀⠀⢀⣿⡇
                ⠘⣶⣤⣉⣛⠻⠇⢠⣿⣾⣿⡄⢻⡇
                 ⣿⣿⣿⣿⣦⣤⣾⣿⣿⣿⣿⣆⠁
        """)
    
    def blocked(self):
        print("""
            ┌────────────────� SILENCE �──────────────────┐
            │         USER BLOCKED BUY FOR ACCES          │
            └─────────────────────────────────────────────┘
            """)
        
    def methods(self):
        print(f"""
        {F.RED}TCP..:  [{F.RED}HOST{F.RESET}] [{F.RED}PORT{F.RESET}] [{F.RED}TIME{F.RESET}] [{F.RED}LAYER 4{F.RESET}] [{F.RED}NON-VIP{F.RESET}]
        {F.RED}UDP..:  [{F.RED}HOST{F.RESET}] [{F.RED}PORT{F.RESET}] [{F.RED}TIME{F.RESET}] [{F.RED}LAYER 4{F.RESET}] [{F.RED}NON-VIP{F.RESET}]
        {F.RED}ACK..:  [{F.RED}HOST{F.RESET}] [{F.RED}PORT{F.RESET}] [{F.RED}TIME{F.RESET}] [{F.RED}LAYER 4{F.RESET}] [{F.RED}NON-VIP{F.RESET}]
        {F.RED}OVH..:  [{F.RED}HOST{F.RESET}] [{F.RED}PORT{F.RESET}] [{F.RED}TIME{F.RESET}] [{F.RED}LAYER 7{F.RESET}] [{F.RED}VIP{F.RESET}]
                    
        {F.RED}HTTPS:  [{F.RED}HOST{F.RESET}] [{F.RED}PORT{F.RESET}] [{F.RED}TIME{F.RESET}] [{F.RED}LAYER 7{F.RESET}] [{F.RED}NON-VIP{F.RESET}]
        
        """)
