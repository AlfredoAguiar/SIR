
function navigateToPage() {
    window.location.href = "info.php";
}



fetch('../Serviços/servico_user_vec.php')
   .then(response => {
      if (!response.ok) {
         throw new Error('Network response was not ok');
      }
      return response.json();
   })
   .then(matriculas => {
      var carMatriculaSelect = document.getElementById('carMatricula');

      matriculas.forEach(function (matricula) {
         var option = document.createElement('option');
         option.value = matricula;
         option.text = matricula;
         carMatriculaSelect.add(option);
      });
   })
   .catch(error => console.error('Error:', error));


   