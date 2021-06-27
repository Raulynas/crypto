const { toArray, flowRight } = require("lodash");

window.onload = function() {
    const cryptoList = document.querySelector(".stocks");

    // search event

    const location = window.location.pathname;

    if (location.includes("stock/index")) {
        const search = document.querySelector(".search input");

        const filteredCrypto = typedChar => {
            Array.from(cryptoList.children)
                .filter(
                    crypto =>
                        !crypto.children[0].textContent
                            .toLowerCase()
                            .includes(typedChar)
                )
                .forEach(crypto => crypto.classList.add("filtered"));

            Array.from(cryptoList.children)
                .filter(crypto =>
                    crypto.children[0].textContent
                        .toLowerCase()
                        .includes(typedChar)
                )
                .forEach(crypto => crypto.classList.remove("filtered"));
        };

        search.addEventListener("keyup", e => {
            const typedChar = search.value.trim().toLowerCase();
            if (e.key === "Escape") {
                search.value = "";
                filteredCrypto(typedChar);
            }
            filteredCrypto(typedChar);
        });

        document.addEventListener("keyup", e => {
            if (e.key === "Escape") {
                search.value = "";
                filteredCrypto("");
            }
        });

        // display crypto price
        const nameTag = document.querySelector(".asset-name");
        const priceTag = document.querySelector(".asset-price");
        let cryptoName = "";

        cryptoList.addEventListener("click", e => {
            Array.from(cryptoList.children).forEach(item =>
                item.classList.remove("selected")
            );
            if (e.target.tagName === "LI") {
                e.target.classList.add("selected");
            }

            if (e.target.tagName === "SPAN") {
                e.target.parentNode.classList.add("selected");
            }

            if (document.querySelector(".selected") != null) {
                cryptoName = document
                    .querySelector(".selected")
                    .firstElementChild.innerHTML.trim();

                nameTag.innerHTML = cryptoName + " price:";

                $.get(priceList, data => {
                    const prices = data[0];
                    console.log(prices);
                    const stocks = data[1];

                    const stock = stocks.filter(stock => {
                        return stock.name == cryptoName;
                    });

                    const priceObject = prices.filter(price => {
                        return price.stock_id == stock[0].id;
                    });

                    const currentPrice = priceObject[0].price;

                    stocks.forEach(element => {
                        if (element.name == cryptoName) {
                            priceTag.innerHTML = currentPrice + " EUR";
                        }
                    });

                    let historicPrices = [];
                    prices.forEach(price => {
                        if (price.stock_id == stock[0].id) {
                            historicPrices.push(price.price);
                        }
                    });

                    const priceData = [[0, 0, 0]];

                    for (let i = 0; i < historicPrices.length; i++) {
                        let row = [i, historicPrices[i], 0];
                        priceData.push(row);
                    }

                    // display graph

                    google.charts.load("current", {
                        packages: ["corechart", "line"]
                    });
                    google.charts.setOnLoadCallback(drawLineColors);

                    function drawLineColors() {
                        var data = new google.visualization.DataTable();
                        data.addColumn("number", "Day");
                        data.addColumn("number", cryptoName);
                        data.addColumn("number", "Market");
                        data.addRows(priceData);
                        // chartdocument.getElementById("chart_div");

                        let options = {
                            hAxis: {
                                title: "Days"
                            },
                            vAxis: {
                                title: "Price"
                            },
                            colors: ["#a52714", "#097138"]
                        };

                        var chart = new google.visualization.LineChart(
                            document.getElementById("chart_div")
                        );
                        chart.draw(data, options);
                    }
                });
            }

            $("html, body").animate({ scrollTop: 0 }, "slow");
        });
    }

    priceGenerator;
};
