<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Winged Packages</title>
    <link rel="stylesheet" href="styles.css"/>
</head>
<body>
    <div class="container">
        <div class="content">
            <div class="leftContent">
                <div class="cargoSpecification">
                    <p>Nazwa przesyłki: <input type="text" id="cargoName" required></p>
                    <p>Waga przesyłki [kg]: <input type="number" id="cargoWeight" required></p>
                    <p>Typ przesyłki: <select id="cargoType" required>
                        <option value="Zwykła">Zwykła</option>
                        <option value="Niebezpieczna">Niebezpieczna</option>
                    </select></p>
                    <button id="packageSubmit" onclick="addPackage()">Dodaj przesyłkę</button>
                </div>
                <p>Twoje przesyłki:</p>
                <div class="cargoList">
                </div>
            </div>
            <div class="rightContent">
                <p>Transport z: <input type="text" name="from" required></p>
                <p>Transport do: <input type="text" name="to" required></p>
                <p>
                    <label for="transportType" required>Typ samolotu:</label>
                    <select id="transportType">
                        <option value="AirbusA380">Airbus A380 (max.35t)</option>
                        <option value="Boeing747">Boeing 747 (max.38t)</option>
                    </select>
                </p>
                <p>
                    <label for="data-transportu">Data transportu:
                        <input type="date" id="data-transportu" name="data-transportu" value="" min="" required>
                        <script src="calendar.js"></script>
                    </label>
                </p>
                <div id="page" class="site">
                    <div class="containerFile">
                        <div class="file-upload">
                            <input type="file" name="files" class="file-input" multiple="multiple">
                            <div class="icon">
                                <ion-icon name="arrow-up-circle-outline"></ion-icon>
                            </div>
                            <h3>Drag & drop files here</h3>
                            <span>- OR -</span>
                            <strong>Browse</strong>
                            <button>
                                <ion-icon name="close"></ion-icon>
                            </button>
                        </div>
                        <div class="list-upload">
                            <ul></ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <button id="transportSubmit" onclick="submitTransport()">Zatwierdz transport</button>
        <div class="footer">
        Filip Krawczak
    </div>
    </div>
    
    
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="dragAndDrop.js"></script>
    <script>
        // Deklaruj zmienną przechowującą informacje o ładunkach
var ladunki = [];

function addPackage() {
    var nazwa = document.getElementById("cargoName").value;
    var waga = document.getElementById("cargoWeight").value;
    var typ = document.getElementById("cargoType").value;

    if (nazwa === "" || waga === "") {
        alert("Proszę uzupełnić wszystkie pola.");
        return;
    }

    if (document.getElementById("transportType").value === "AirbusA380" && waga >= 35000) {
        alert("Za duża waga ładunku!");
        return;
    }

    if (document.getElementById("transportType").value === "Boeing747" && waga >= 38000) {
        alert("Za duża waga ładunku!");
        return;
    }

    // Dodaj informacje o ładunku do zmiennej 'ladunki'
    ladunki.push({ nazwa: nazwa, waga: waga, typ: typ });

    var nowaPrzesylka = document.createElement("div");
    nowaPrzesylka.innerHTML = "Nazwa: " + nazwa + ", Waga: " + waga + "kg, Typ: " + typ;
    nowaPrzesylka.style.backgroundColor = "lightskyblue";
    nowaPrzesylka.style.opacity = "90%";
    nowaPrzesylka.style.border = "1px solid black";
    nowaPrzesylka.style.margin = "1px";

    var listaPrzesylek = document.querySelector(".cargoList");
    var minusButton = document.createElement("button");
    minusButton.style.margin = "10px";
    minusButton.textContent = "Usuń";
    minusButton.addEventListener("click", function() {
        listaPrzesylek.removeChild(nowaPrzesylka);
    });

    nowaPrzesylka.appendChild(minusButton);
    listaPrzesylek.appendChild(nowaPrzesylka);

    document.getElementById("cargoName").value = "";
    document.getElementById("cargoWeight").value = "";
    document.getElementById("cargoType").value = "Zwykła";
}

function submitTransport() {
    var transportFrom = document.getElementsByName("from")[0].value;
    var transportTo = document.getElementsByName("to")[0].value;
    var transportType = document.getElementById("transportType").value;
    var transportDate = document.getElementById("data-transportu").value;

    if (transportFrom === "" || transportTo === "" || transportDate === "") {
        alert("Proszę uzupełnić wszystkie pola.");
        return;
    }

    if (document.querySelector(".cargoList").children.length === 0) {
        alert("Proszę uzupełnić dane dotyczące przesyłki oraz dodać ją do listy.");
        return;
    }

    console.log("Transport z: " + transportFrom);
    console.log("Transport do: " + transportTo);
    console.log("Typ samolotu: " + transportType);
    console.log("Data transportu: " + transportDate);

    var tekst = "Transport z: " + transportFrom + "\n";
    tekst += "Transport do: " + transportTo + "\n";
    tekst += "Typ samolotu: " + transportType + "\n";
    tekst += "Data transportu: " + transportDate + "\n";

    if (ladunki.length > 0) {
        tekst += "\nDodane ładunki:\n";
        for (var i = 0; i < ladunki.length; i++) {
            tekst += "Nazwa: " + ladunki[i].nazwa + ", Waga: " + ladunki[i].waga + "kg, Typ: " + ladunki[i].typ + "\n";
        }
        tekst += "\n\n\n";
    }

    var data = new FormData();
    data.append('text', tekst);

    var request = new XMLHttpRequest();
    request.open('POST', 'uploadText.php');
    request.send(data);

    alert("Transport został zamówiony!");
}

    </script>
</body>
</html>
