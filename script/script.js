let preveiwContainer = document.querySelector('.partenaire-preview');
let previewBox = preveiwContainer.querySelectorAll('.preview');

document.querySelectorAll('.partenaire-container .partenaire').forEach(partenaire =>{
    partenaire.onclick = () =>{
      preveiwContainer.style.display = 'flex';
      let name = partenaire.getAttribute('data-name');
      previewBox.forEach(preview =>{
        let target = preview.getAttribute('data-target');
        if(name == target){
          preview.classList.add('active');
        }
      });
    };
});

previewBox.forEach(close =>{
    close.querySelector('.fa-times').onclick = () =>{
      close.classList.remove('active');
      preveiwContainer.style.display = 'none';
    };
  });