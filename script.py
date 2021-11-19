import requests
import csv
from bs4 import BeautifulSoup
 
response = requests.get('https://www.alltime.ru/watch/filter/brand:casio/collection:g_shock/')
soup = BeautifulSoup(response.text, 'html.parser')
result = soup.select('.catalog-item-name')
Images = soup.select('.catalog-item-photo-holder')
Opisanie = soup.select('.catalog-item-features')

#print(result[1])

with open('G-Shock.csv', mode='w', encoding='utf-8') as w_file:
    file_writer = csv.writer(w_file, delimiter=',')
    file_writer.writerow(['Модель', 'Цена', 'Описание', 'Ссылка'])

iter = 0

for i in result[0:]:
        
    ClockModel = i.find('span').text + '|'
    Price = i.parent.parent.findAll('span')[1].text.strip() + 'уб|'
    Opisanie_Model = Opisanie[iter].text.strip() + '|'
    Way = '/IconAndImages/G-Shock' + str(iter + 1) + '.jpg'
        
    All = (ClockModel + Price + Opisanie_Model + Way).split('|')

    with open('G-Shock.csv', mode='a', encoding='utf-8') as w_file:
        file_writer = csv.writer(w_file, delimiter=',')
        file_writer.writerow(All)
    
    iter += 1        

    # for i in Images:


    #print(i.find('a').find('span').text)
    #print(i.find('img'))
    #print(i)
    """ print(i.find('img')['src'])
    ImgUrl = 'https://www.alltime.ru' + i.find('img')['src']    
    print(ImgUrl)
    Res = requests.get(ImgUrl)
    f = open('IconAndImages/clock.jpg', 'wb')   
    f.write(Res.content)
    f.close()""" 
