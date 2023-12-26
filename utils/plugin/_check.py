from utils.configuration.application import METHOD
import re

def is_valid_host(host):
    if host.startswith("https://") or host.startswith("http://"):
        return True
    else:
        # Vérifier si host est un hôte valide
        pattern = r"^(?:[a-z0-9](?:[a-z0-9-]{0,61}[a-z0-9])?\.)+[a-z0-9][a-z0-9-]{0,61}[a-z0-9]$"
        return re.match(pattern, host) is not None
    
def is_valid_port(port):
    if port.isdigit():
        return True
    else:
        return False
    
def is_valid_time(time):
    if time.isdigit():
        return True
    else:
        return False
    
def is_valid_method(method):
    if method in METHOD:
        return True
    else:
        return False
    
