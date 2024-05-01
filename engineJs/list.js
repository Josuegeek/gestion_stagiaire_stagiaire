// Création d'un objet XMLHttpRequest
let xhr = new XMLHttpRequest();

let table = document.getElementById('workTable');
const formTitle = document.getElementById("form-title"),
    workTitle = document.getElementById("work-title"),
    datePubLbl = document.getElementById("pub-date"),
    dateFinLbl = document.getElementById("fin-date"),
    idInput = document.getElementById("id"),
    commentInput = document.getElementById("comment"),
    fileSpan = document.querySelector(".file-shower span"),
    operationInput = document.getElementById("operation"),
    btnSubmit = document.getElementById("btn-submit"),
    fileInput = document.getElementById("fichier"),
    fileImg = document.querySelector(".file-shower i"),
    workForm = document.getElementById("work-form"),
    fileCheckDiv = document.getElementById("file-check-div"),
    fileCheck = document.getElementById("file-check"),
    fileDiv = document.getElementById("file-div");

if (document.getElementById("searchBtn")) {
    document.getElementById("searchBtn").addEventListener('click', () => {
        let searchText = document.getElementById('searchText');
        search(searchText.value);
    });
}

let tbody = table.querySelector('tbody');
// Définition de la méthode et de l'URL de la requête
xhr.open("POST", "./enginePhp/lire.php?id=" + 14, true);
xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");

let allWorks = [], notSubmitted = [], subimitted = [];

// Ajout d'un événement de rappel à l'événement `load`
xhr.onload = function () {
    try {
        // Récupération des données JSON
        var data = xhr.responseText;
        //console.log(xhr.response, "Response");
        var d = JSON.parse(data);
        if (d.status == 'success') {
            const jsonObj = JSON.parse(data);
            allWorks = jsonObj.allWorks;
            notSubmitted = jsonObj.nSWorks;
            subimitted = jsonObj.sWorks;
            //finishedStage = jsonObj.finishedStage;

            tbody.innerHTML = "";
            //console.log(allWorks, proStage, academicStage, finishedStage);
            let classi = "";
            for (let i = 0; i < allWorks.length; i++) {
                if (allWorks[i].statut.includes("Deposé")) {
                    //if (allWorks[i].status.includes("fini"))
                    classi = "status pending";
                    //else classi = "status delivered";
                }
                else classi = "status return";

                let point_obtenu = allWorks[i].point_obtenu;
                if (allWorks[i].point_obtenu == null) {
                    point_obtenu = "-/20";
                }
                else {
                    point_obtenu = "<b>" + allWorks[i].point_obtenu + "</b> /20";
                }

                tbody.innerHTML += `
                <tr>
                    <td>${allWorks[i].id}</td>
                    <td>${allWorks[i].description}</td>
                    <td>${allWorks[i].date_pub}</td>
                    <td>${allWorks[i].date_fin}</td>
                    <td>${allWorks[i].statut}</td>
                    <td>${point_obtenu}</td>
                    <td>
                        <ul>
                            <li style="${(allWorks[i].statut == "Deposé") ? "display:none;" : "display:block;"}" onclick="showEditForm(${allWorks[i].id}, 'insert')">
                                <a class="small-btn bg-primary" href="#">
                                    Deposer
                                </a>
                            </li>
                            <li style="${(allWorks[i].statut != "Deposé") ? "display:none;" : "display:block;"}" onclick="showEditForm(${allWorks[i].id}, 'edit')">
                                <a class="small-btn bg-yellow" href="#">
                                    Modifier
                                </a>
                            </li>
                        </ul>
                    </td>
                </tr>
                `;
            }

            //Ajout des markers des accords
        }
        else {
            alert("Erreur de lecture dans la base des données :" + data.msg)
        }
    }
    catch (e) {
        alert("Erreur de lecture dans la base des données :" + e)
    }

};
// Envoi de la requête
xhr.send();

function showEditForm(id, op) {

    let work = {};

    if (op == "edit") {
        work = subimitted.find(w => w.id == id)
    }
    else {
        work = allWorks.find(w => w.id == id)
    }
    //console.log(work, allWorks, id);
    if (work) {
        //console.log(work);
        showIsjPopupForm(work, op);
    }
}

function showIsjPopupForm(work, op) {
    workForm.reset();
    //console.log(work)
    if (work) {
        formTitle.textContent = (op == "edit") ? "Modifier le travail N° " + work.id : "Deposer le travail N° " + work.id;
        workTitle.textContent = work.description;
        datePubLbl.textContent = "Publié en " + work.date_pub;
        dateFinLbl.textContent = "A déposer jusqu'au " + work.date_fin;
        commentInput.value = (op == "edit") ? work.commentaire : "";
        idInput.value = work.id;
        fileSpan.textContent = (op == "edit") ? work.fichier : "Aucun fichier choisi";
        if (op == "edit") {
            btnSubmit.textContent = "Modifier";
            operationInput.value = "edit";
            fileImg.classList.remove("invisible");
            fileCheckDiv.classList.remove("invisible");
            fileDiv.classList.add("invisible");
            fileDiv.classList.remove("inputContainer");
            fileInput.disabled = true;
        }
        else {
            btnSubmit.textContent = "Deposer";
            operationInput.value = "insert";
            fileImg.classList.add("invisible")
            fileCheckDiv.classList.add("invisible");
            fileDiv.classList.remove("invisible");
            fileDiv.classList.add("inputContainer");
            fileInput.disabled = false;
        }
        showIsjForm2(0);
    }
}

function reloadTable() {
    xhr.open("POST", "./enginePhp/lire.php?id=" + 14, true);
    xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xhr.send();

    search("");
}

function search(mot) {
    const rows = tbody.querySelectorAll('tr');
    //console.log("Searching", mot)
    rows.forEach(row => {
        const cells = row.querySelectorAll("td");
        let found = false;

        if (mot == "") {
            //console.log("no Term");
            row.style.display = 'table-row';
        }
        else {
            cells.forEach(cell => {
                const cellText = cell.textContent.toLocaleLowerCase();
                if (cellText.includes(mot)) {
                    found = true;
                    //console.log("Found", row);
                    //row.style.display = found ? 'table-row' : 'noe';
                    //return;
                }
                row.style.display = found ? 'table-row' : 'none';
            });
        }

    });
}

fileInput.addEventListener("change", (event) => {
    const fichiers = event.target.files;
    //console.log(fichiers)
    if (fichiers.length > 0) {
        fileImg.classList.remove("invisible");
        fileSpan.textContent = fichiers[0].name;
    }
    else {
        fileImg.classList.add("invisible");
    }

});

fileCheck.addEventListener("change", (e) => {
    if (e.target.checked) {
        fileDiv.classList.remove("invisible");
        fileDiv.classList.add("inputContainer");
        fileInput.disabled = false;
    }
    else {
        fileDiv.classList.add("invisible");
        fileDiv.classList.remove("inputContainer");
        fileInput.disabled = true;
    }
});

function showForm() {

    showIsjForm2(0);

}
