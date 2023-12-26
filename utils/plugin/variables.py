import getpass, os, psutil, signal

# function for block interrupt


def get_user():
    return getpass.getuser()

def cls():
    if os.name == "nt":
        os.system("cls")
    else:
        os.system("clear")

def block_interrupt():
    signal.signal(signal.SIGINT, signal.SIG_IGN)
     
def setup():
    user = get_user()
    if user == "root":
        pass
    else:
        block_interrupt()



