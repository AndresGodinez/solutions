// Notify
function showNotification(title = "Whirpool", text = "Normalmente este es el cuerpo de la notificacion :) ", type = "info") {
    //toastr.success("success");
    //Types: info, warning, error, success

    toastr.options.closeButton = true;
    toastr.options.progressBar = true;

    if (type == "info") return toastr.info(text, title);
    if (type == "success") return toastr.success(text, title);
    if (type == "error") return toastr.error(text, title);
    if (type == "warning") return toastr.warning(text, title);
}
// Add Class
function removeOrAddStyleClass(element = null, style = null, action = 'add') {
    if (element && style) {
        var element = document.getElementById(element);
        if(!element)
        element = document.getElementsByName(element)[0];
        if (action == "add") { element.classList.add(style); }
        else { element.classList.remove(style); }
    }
    return;
}
// Form Validations
// Only numbers
function isInputNumber(evt) {
    var ch = String.fromCharCode(evt.which);
    if (!(/[0-9]/.test(ch))) { evt.preventDefault(); }
}
// Add Example Element whirpool - Question, type(with file or not) and tooltip
// 1.- Dictionary to add - dictionaryLabels={ pregunta: "Pregunta uno", tipo: 1, tooltip: "Comentario" }
// 2.- Title
// 3.- Options (array)
// 3.- Type - Text(1), Number(2)
// 4.- Name_number (Name by %)
function addNewCustomInput(dictionaryLabels, destinationElement) {
    var container = document.getElementById(destinationElement);
    while (container.hasChildNodes()) { container.removeChild(container.lastChild); }

    var striped = false;
    for (var key in dictionaryLabels) {
        if (key % 3 == 0)
            striped = !striped;
        var label = dictionaryLabels[key]['pregunta'];
        var inputId = dictionaryLabels[key]['id_pregunta'];
        var type = dictionaryLabels[key]['tipo'];
        var toolTip = dictionaryLabels[key]['tooltip'];

        var divColumn = document.createElement("div");
        divColumn.id = destinationElement + '-divColumn-' + key;
        divColumn.className = 'col-md-4  p-2 border ' + (striped ? ' striped' : '');
        container.appendChild(divColumn);

        var inputLabel = document.createElement("label");
        inputLabel.innerHTML = label;

        divColumn.appendChild(inputLabel);

        switch (type) {
            case 1:
                var input = createTextInput(inputId, toolTip)
                //input.required = true;
                divColumn.appendChild(input);
                break;
            case 2:
                this.createFileInput(divColumn, inputId, toolTip);
                break;
            case 3:
                var input = createTextInput(inputId, toolTip)
                //input.required = true;
                divColumn.appendChild(input);
                this.createFileInput(divColumn, inputId, toolTip);
                break;
        }
    }
}

function createTextInput(inputId, toolTip) {
    var input = document.createElement("input");
    input.className = "form-control";
    input.id = "answer" + inputId;
    input.name = "answer" + inputId;
    input.type = "text";
    input.alt = toolTip;
    input.setAttribute('data-toggle', 'tooltip');
    input.setAttribute('data-html', 'true');
    input.setAttribute('title', toolTip);
    return input;

}


function createFileInput(divColumn, inputId, toolTip) {
    var inputFile = document.createElement("input");
    inputFile.type = "file";
    inputFile.id = "file-" + inputId;
    //inputFile.name = "file-" + inputId;
    inputFile.className = "col-md-12";
    inputFile.setAttribute('title', toolTip);
    divColumn.appendChild(inputFile);

    var inputSpan = document.createElement("span");
    inputSpan.innerHTML = "Por favor selecciona un archivo";
    inputSpan.id = "span-" + inputId;
    inputSpan.className = "hidden";
    inputSpan.style.color = "red";

    divColumn.appendChild(inputSpan);
    divColumn.appendChild(createHiddenInput(inputId));
}

function createHiddenInput(inputId){
    var input = document.createElement("input");
    input.id = "file" + inputId;
    input.name = "file" + inputId;
    input.type = "hidden";
    return input;
}
