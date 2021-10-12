import requests
import json

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

f = open("test-list.txt", "w")

f.write("<ul>\n")

count = 0
for x in y:
    count += 1
    id = x["id"]
    f.write("\t<li>"
            + f"<a href=\"portfolio?addCoin={id}\" class=\"flex p-2 text-black hover:bg-gray-200 cursor-pointer\">"
            + "<span><img class=\"w-7\" src=\"" + x["image"] + "\" /></span>"
            # + " "
            + "<span class=\"pl-3 mx-0 my-auto\">" + x["name"] + "</span>"
            + "</a>"
            + "</li>\n"
            )

f.write("</ul>")

f.close()
