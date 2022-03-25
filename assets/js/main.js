function sidebarToggle(){
  let wrapper = document.getElementById('wrapper');

  wrapper.classList.toggle('expand');
  document.getElementById('sidebarAngleBtn').classList.toggle('rotate-180');
}