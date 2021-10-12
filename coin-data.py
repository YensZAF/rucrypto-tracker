import requests
import json
import csv

# r = requests.get('https://api.coingecko.com/api/v3/coins/markets')
# 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=10&page=1'

ploads = {
    'vs_currency': 'usd',
    'order': 'market_cap_desc',
    'per_page': 100,
    'page': 1
}

r = requests.get(
    'https://api.coingecko.com/api/v3/coins/markets', params=ploads)

# print(r.text)
# print(r.url)


y = json.loads(r.text)

f = csv.writer(open("test.csv", "w", newline=''))

# Write CSV Header, If you dont need that, remove this line
f.writerow(["currency_id", "currency_name", "currency_symbol", "currency_pic"])

count = 0
for x in y:
    count += 1
    f.writerow([count,
                x["name"],
                x["symbol"],
                x["image"]
                ])
