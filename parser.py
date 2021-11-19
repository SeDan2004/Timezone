import requests
import csv
from bs4 import BeautifulSoup

def get_data(SiteUrl, ClockModel, Price, Opisanie, Model, UrlImage):
    
    response = requests.get(SiteUrl)
    soup = BeautifulSoup(response.text, 'html.parser')

    Name = soup.select(ClockModel)
    Price = soup.select(Price)
    UrlImage = soup.select(UrlImage)
    Opisanie = soup.select(Opisanie)
    iter = 0

    UrlImage.remove(UrlImage[0])


    with open('ClockCsv/' + Model + '.csv', mode='w', encoding='utf-8') as File:
        file_writer = csv.writer(File, delimiter=';')
        file_writer.writerow(['Модель', 'Цена', 'Описание', 'Ссылка на картинку'])

    for i in UrlImage:
        Url = SiteUrl[slice(0, SiteUrl.find('ru') + 2)] + i.find('img')['src']
        f = open('IconAndImages/' + Model + str(iter + 1) + '.jpg', 'wb')
        f.write(requests.get(Url).content)
        f.close()

        ClockModel = Name[iter].text + '|'
        PriceClock = Price[iter].text.strip() + 'уб|'
        OpisanieClock = Opisanie[iter].text.strip() + '|'
        Way = 'IconAndImages/' + Model + str(iter + 1) + '.jpg'
        All = (ClockModel + PriceClock + OpisanieClock + Way).split('|')
        print(ClockModel, PriceClock, Way, sep=';')
        with open('ClockCsv/' + Model + '.csv', mode='a', encoding='utf-8') as File:
            file_writer = csv.writer(File, delimiter=';')
            file_writer.writerow(All)

        iter += 1

model = ['swiss-military', 'orient']

for i in model:
    get_data (
    f"https://www.alltime.ru/watch/filter/brand:{i}/", 
    "span[itemprop='name']", 
    ".catalog-item-price",
    ".catalog-item-features",
    f"{i.capitalize()}",
    ".catalog-item-photo-holder"
    )