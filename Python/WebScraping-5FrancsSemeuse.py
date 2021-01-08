import mechanize # https://github.com/python-mechanize/mechanize / A installer à la main : pip3 install mechanize
from datetime import datetime
from bs4 import BeautifulSoup # pip3 install BeautifulSoup4
#pip3 install mariadb
import mariadb
import sys

br = mechanize.Browser()
br.set_handle_robots(False) # Ne respecte pas les restrictions d'un potentiel robots.txt
br.set_handle_refresh(False)
br.addheaders = [{'User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'}]
br.set_proxies({"http": "127.0.0.1:8080"}) # Très utile pour debugger

def WebScrap(item, url):
    print("> ", item, " - ", url)
    html = br.open(url).read()
    soup = BeautifulSoup(html, "html.parser")

    try:
        itemValue = soup.find_all("span", {"id": "pv"})[0].get_text().strip()
    except:
        print("Unexpected error:", sys.exc_info()[0])
        itemValue = -1

    if itemValue == -1:
        try:
            itemValue = soup.find_all("span", {"id": "tpv"})[0].get_text().strip()
        except:
            print("Unexpected error:", sys.exc_info()[0])
            itemValue = -1

    print(itemValue)

    if itemValue == -1:
        return

    try:
        conn = mariadb.connect(
            user="webscraping",
            password="B+CP%ES/+.N+OD6r:t?6e>",
            host="192.168.1.110",
            port=3306,
            database="web_scraping"
        )
    except mariadb.Error as e:
        print(f"Error connecting to MariaDB Platform: {e}")
        sys.exit(1)

    # Get Cursor
    cur = conn.cursor()

    typeValue = "Float"

    try:
        cur.execute("INSERT INTO `ItemValueOverTime` (Item,TypeValue,FloatValue) VALUES (?,?,?)", (item,typeValue,itemValue))
    except mariadb.Error as e:
        print(f"Error: {e}")

    conn.commit()

    conn.close()

WebScrap("5 FRANCS SEMEUSE 1959-1969","https://www.achat-or-et-argent.fr/argent/5-francs-semeuse-1959-1969/22")
WebScrap("LINGOT 250G ARGENT","https://www.achat-or-et-argent.fr/argent/lingot-250g-argent/3602")
WebScrap("20 FRANCS NAPOLÉON","https://www.achat-or-et-argent.fr/or/20-francs-napoleon/6")
