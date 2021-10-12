
f = open("test-table.txt", "w")

f.write("<table class=\"divide-y divide-gray-300 \">\n"
        + "\t<thead class=\"bg-gray-50\">\n"
        + "\t\t<tr>\n"
        + "\t\t\t<th class=\"px-6 py-2 text-xs text-gray-500\">#</th>\n"
        + "\t\t\t<th class=\"px-6 py-2 text-xs text-gray-500\">Pic</th>\n"
        + "\t\t\t<th class=\"px-6 py-2 text-xs text-gray-500\">Name</th>\n"
        + "\t\t\t<th class=\"px-6 py-2 text-xs text-gray-500\" >Price</th>\n"
        + "\t\t\t<th class=\"px-6 py-2 text-xs text-gray-500\" >24h Change</th>\n"
        + "\t\t</tr>\n"
        + "\t</thead>\n"
        + "\t<tbody class=\"bg-white divide-y divide-gray-300\">\n"
        )

count = 0
for x in range(1, 11):
    f.write("\t\t<tr class=\"whitespace-nowrap\">\n"
            + f"\t\t\t<td class=\"px-6 py-4 text-sm text-gray-500\">{x}</td>\n"
            + f"\t\t\t<td class=\"px-6 py-4\"><div id=\"topCoinPic-{x}\" class=\"text-sm text-gray-900\">Pic</div></td>\n"
            + f"\t\t\t<td class=\"px-6 py-4\"><div id=\"topCoinName-{x}\" class=\"text-sm text-gray-500\">Coin</div></td>\n"
            + f"\t\t\t<td id=\"topCoinPrice-{x}\" class=\"px-6 py-4 text-sm text-gray-500\"> $0.00</td>\n"
            + f"\t\t\t<td id=\"topCoinChange-{x}\" class=\"px-6 py-4 text-sm text-gray-500\">$0.00</td>\n"
            + "\t\t</tr>\n"
            )

f.write("\t</tbody>\n"
        + "</table>"
        )

f.close()
