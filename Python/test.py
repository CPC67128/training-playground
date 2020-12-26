import mechanize # https://github.com/python-mechanize/mechanize / A installer à la main
from bs4 import BeautifulSoup # pip3 install BeautifulSoup4

br = mechanize.Browser()
br.set_handle_robots(False) # Ne respecte pas les restrictions d'un potentiel robots.txt
br.set_handle_refresh(False)
br.addheaders = [{'User-Agent', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36'}]
br.set_proxies({"http": "127.0.0.1:8080"}) # Très utile pour debugger

html = br.open("https://stevefuchs.fr/blog/").read()

soup = BeautifulSoup(html, "html.parser")
labels_articles = soup.find_all("a", {"class": "post-link"})

for link in labels_articles:
    print(link.get_text().strip())
    print(link.get('href'))

"""
br.select_form(nr=0)
br.form['SearchText'] = 'Python'
response = br.submit()
# mechanize ne prends pas en charge le Javascript, si besoin, nous devons passer par selenium - https://selenium-python.readthedocs.io/
"""
