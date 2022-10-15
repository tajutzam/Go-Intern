
<script>
// const navbar = document.getElementsByTagName('nav');
// window.onscroll = () => {
//     if (window.scrollY > 300) {
//         navbar.classList.add('nav-active');
//     } else {
//         navbar.classList.remove('nav-active');
//     }
// };

// console.log(navbar);
window.onscroll = () => {scrolNavbar()};

scrolNavbar = () =>{

    const navbar = document.getElementById('navbar');
    if(window.scrollY > 200){
        navbar.classList.add('navbar-change-bg');
    }else{
        navbar.classList.remove('navbar-change-bg');
    }
    
}
console.log('halo');
</script>
