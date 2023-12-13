let btnMP = document.getElementById("pgMp");
btnMP.addEventListener('click',function(e){
  let cel = document.getElementById("telefone").value;
    let nome = document.getElementById("nome").value;
     let sobrenome = document.getElementById("sobre").value;
    let email = document.getElementById("email").value;
    let cpf = document.getElementById("cpf").value;
      fetch(`assets/api/api.php?nome=${nome}&sobre=${sobrenome}&email=${email}&cpf=${cpf}&valor=${soma(prince)}&cel=${cel}&qtd=${cotas}`,{
        method: "GET",
      })
      .then(response => response.json())
      .then((json)=>{
        console.log(json)
        let id = json.id;
        let ticketURL = json.point_of_interaction.transaction_data.ticket_url;
        console.log("ID:", id);  // Saída: ID: 1315142150
        console.log("Ticket URL:", ticketURL);
        let QR = json.point_of_interaction.transaction_data.qr_code_base64
        let COPY = json.point_of_interaction.transaction_data.qr_code;
        console.log(document.getElementById("qr"))
        document.getElementById("qr").innerHTML = `<img src="data:image/jpeg;base64,${QR}" width="170"/>`
        document.getElementById("copy").innerHTML = `<label class="input-group-text" for="copiar">Copiar Hash:</label><input class="form-control" type="text" id="copiar"  value="${COPY}"/>`
        fetch(`assets/api/temp_data.php?nome=${nome}&sobre=${sobrenome}&email=${email}&cpf=${cpf}&valor=${soma(prince)}&cel=${cel}&qtd=${cotas}&id=${id}`)
      })
      .catch(err => console.log(err))
}
