
let burger = document.querySelector('.burger');
let nav = document.querySelector('header nav');
let header = document.querySelector('header');
let lis = document.querySelectorAll('.ul_navbar li');
let btnprofil = document.querySelectorAll('.btn_modif');
let lidash = document.querySelectorAll('.lidash');
let delatecomment =document.querySelectorAll('.delate_comment');

// console.log(lis)
burger.addEventListener('click', function(){

  this.classList.toggle('active')
  nav.classList.toggle('open')
})

lis.forEach(element => {
 
  element.addEventListener('click', function(){
   
    nav.classList.toggle('open')


  })

  
});

btnprofil.forEach(element => {
  element.addEventListener('click',function(){
    let num = this.getAttribute('data-button')
    
    document.querySelector('.btn_modif.active').classList.remove('active');
    this.classList.add('active');
    document.querySelector('.modifierprofil').classList.remove('active');
    document.querySelector('.infotab').classList.remove('active');
     document.querySelector('.commentprofil').classList.remove('active')
    document.querySelector('#info'+num).classList.add('active')
     
  })
});

lidash.forEach(element => {

   element.addEventListener('click', function(){
    let num = this.getAttribute('data-li')
   document.querySelector('.lidash.active').classList.remove('active');
   this.classList.add('active');
   
   document.querySelector('.dashinfo.active').classList.remove('active')
   document.querySelector('.itemdash'+num).classList.add('active');


  })
  
});


// *****gestion des boittes modales ****
let modalcontainer  = document.querySelector('.modal-container')
let classmodaltriggerModifier = document.querySelectorAll('.modal-triggerModifier')

let classmodaltriggerAnnuler = document.querySelectorAll('.modal-triggerAnnuler')
let classmodaltriggersuprimer = document.querySelectorAll('.modal-triggersuprimer')
let modaltrigger = document.querySelectorAll('.modal-trigger')
let btnmodifier = document.querySelector('.btn_modifier')
let btnannuler = document.querySelector('.btn_annuler')
let btnsuprimer = document.querySelector('.btn_suprimer')


// les functions pour les boites modals
function modaltriggerModifier(elements){
   elements.forEach(element => {
  
  
    element.addEventListener('click', function(){
    
      let url = '';
      
       url = this.getAttribute('data-url');
      
      modalcontainer.classList.toggle('active');
      // document.querySelector('.modal').classList.remove('active')
      document.querySelector('.modal-modifier').classList.toggle('active')
      if( url.indexOf('reservations')>-1){
       
    
        h2text ='voulez-vous vraiment modifier cette reservation';
        
      }else if(url.indexOf('annonces')>-1){
        h2text ='voulez-vous vraiment modifier ce Menu'
        

      }else if(url.indexOf('users')>-1){
        h2text ='voulez-vous vraiment modifier  cet utilisateur'
        

      }
let h2modal = document.querySelector('.modal-modifier h2')
  
      h2modal.innerHTML = '';
      h2modal.innerHTML =  h2text;
    
      btnmodifier.href = url;
      
  
      
    })
  });

}

function modaltriggerAnnuler( elements ){
  elements.forEach(element => {
   
 
   element.addEventListener('click',function (){
  
    modalcontainer.classList.toggle('active');
      
       url = this.getAttribute('data-url');
      
      // document.querySelector('.modal').classList.remove('active')
      document.querySelector('.modal-annuler').classList.toggle('active');
      if( url.indexOf('reservations')>-1){
         
      
        h2text ='voulez-vous vraiment annuler cette reservation';
        
      }
  let h2modal = document.querySelector('.modal-annuler h2')
  
      h2modal.innerHTML = '';
        h2modal.innerHTML=  h2text;
      
      // btnsuprimer.dataset.id = url;
      btnannuler.addEventListener('click',function(){
        let xmlhttp = new XMLHttpRequest();
    
        xmlhttp.open(
          "GET",url
          
        );
      
        xmlhttp.send();
      
        modalcontainer.classList.toggle('active');
        document.querySelector('.modal-annuler').classList.toggle('active');
      
      })
    
  
    
  } )
});


} 

function delatereserv(){

  

  modalcontainer.classList.toggle('active');
  
   url = this.getAttribute('data-url');
  console.log(url)
  // document.querySelector('.modal').classList.remove('active')
  document.querySelector('.modal-suprimer').classList.toggle('active');
  if( url.indexOf('reservations')>-1){
     
  
    h2text ='voulez-vous vraiment supprimer cette reservation';
    
  }else if(url.indexOf('annonces')>-1){
    h2text ='voulez-vous vraiment supprimer ce Menu'
    

  }else if(url.indexOf('users')>-1){
    h2text ='voulez-vous vraiment supprimer  cet utilisateur'
    

  }else if (url.indexOf('comments')>-1){
    h2text ='voulez-vous vraiment supprimer  ce commentaire'
  }
let h2modal = document.querySelector('.modal-suprimer h2')

  h2modal.innerHTML = '';
    h2modal.innerHTML=  h2text;
  
  // btnsuprimer.dataset.id = url;
  btnsuprimer.addEventListener('click',function(){
    let xmlhttp = new XMLHttpRequest();

    xmlhttp.open(
      "GET",url
      
    );
  
    xmlhttp.send();
  
    modalcontainer.classList.toggle('active');
    document.querySelector('.modal-suprimer').classList.toggle('active');
  
  })

  // this.removeEventListener('click',delatereserv)
  
}

function modaltriggerDelate( elements ){


 elements.forEach(element => {
   
 
   element.addEventListener('click',delatereserv)
});


} 

 modaltriggerModifier (classmodaltriggerModifier);

 modaltriggerDelate (classmodaltriggersuprimer )
 modaltriggerAnnuler(classmodaltriggerAnnuler)




//**********


// *******gestion des annonces *****

// *********ckeckbox admin ***


// import Swup from 'swup';


window.onload = () => {

  let checkboxAnnonces = document.querySelectorAll(".checkboxAnnonces");
  let checkboxComments = document.querySelectorAll(".checkboxComments");
  let likes = document.querySelectorAll(".iconlike");
  let dislikes = document.querySelectorAll(".icondislike");

  for (let checkbox of checkboxAnnonces) {
    checkbox.addEventListener("click", ActiverAnnonce);
  }
  for (let checkbox of checkboxComments) {
    checkbox.addEventListener("click", ActiverComment);
  }
  for (let like of likes) {
    like.addEventListener("click", Addlike);
  }
  for (let dislike of dislikes) {
    dislike.addEventListener("click", Adddislike);
  }
};

function ActiverAnnonce() {
  let xmlhttp = new XMLHttpRequest();

  xmlhttp.open("GET", "admin/activeAnnonce/" + this.dataset.id);

  xmlhttp.send();
}

function ActiverComment() {
  let xmlhttp = new XMLHttpRequest();

  xmlhttp.open("GET", "admin/activeComment/" + this.dataset.id);

  xmlhttp.send();
}

function Addlike() {
  let xmlhttp = new XMLHttpRequest();

  xmlhttp.open(
    "GET",
    "http://the-bbq-restaurant/likes/like/" + this.dataset.id
  );

  xmlhttp.send();
}
function Adddislike() {
  let xmlhttp = new XMLHttpRequest();
  console.log(this);
  xmlhttp.open(
    "GET",
    "http://the-bbq-restaurant/likes/dislike/" + this.dataset.id
  );

  xmlhttp.send();
}

delatecomment.forEach(btncomment => {

  console.log(btncomment);
  btncomment.addEventListener('click',function(){
    let xmlhttp = new XMLHttpRequest();
  
    xmlhttp.open(
      "GET", "http://the-bbq-restaurant/comments/delete/"+ this.dataset.id
      
    );
  
    xmlhttp.send();
  
  
  
  })
  
});



// swiper **************
var swiper = new Swiper(".mySwiper", {
  cssMode: true,
  navigation: {
    nextEl: ".swiper-button-next",
    prevEl: ".swiper-button-prev",
  },
  pagination: {
    el: ".swiper-pagination",
  },
  mousewheel: true,
  keyboard: true,
});

//******animation */

gsap.from(".title .home_p1,.title h2,.text_menu h2", {
  opacity: 0, 
  y: -300, 
  duration: 2
});

gsap.from(".home .home_p2,.text_menu p", {
  opacity: 0, 
  y: 300, 
  
  duration: 2,
});

gsap.fromTo(".btn_explore",{opacity:0,x:-3000}, {
  
  opacity: 1, 
  x: 0, 
  duration: 1.5,
  ease: "power2.out",
  delay:0.5
 
  

});

gsap.fromTo(".btn_reserve",{opacity:0,x:3000},{
  
  opacity: 1, 
  x: 0,
  duration: 1.5,
  ease: "power2.out",
   delay:0.5
  
});

gsap.registerPlugin(ScrollTrigger);

gsap.from(".presente_text", {
  scrollTrigger:{
  trigger:".presente_text",
  toggleActions : "play none none none",
  start: "center 70%",

  
  },
opacity:0,
y:200,
duration:1.5,
ease: "power2.out",


});
gsap.from(".imagetrigger1", {
  scrollTrigger:{
  trigger:".imagetrigger1",
  toggleActions : "play none none none",
  start: "bottom 70%",
  
  },
opacity:0,
x:200,
duration:1.5,
ease: "power2.out",


});
gsap.from(".imagetrigger2", {
  scrollTrigger:{
  trigger:".imagetrigger2",
  toggleActions : "play none none none",
  start: "top 70%",
  
  },
opacity:0,
x:-200,
duration:1.5,
ease: "power2.out",


});
gsap.from(".chef", {
  scrollTrigger:{
  trigger:".chef",
  

  toggleActions : "play none none none",
  start: "top 70%",
  
  },
opacity:0,
y:100,
duration:1.5,
ease: "power2.out",


});
gsap.from(".team", {
  scrollTrigger:{
  trigger:".team",
  

  toggleActions : "play none none none",
  start: "top 70%",
  
  },
opacity:0,
y:100,

duration:1.5,
ease: "power2.out",


});
gsap.from(".banniere h1,.banniere p", {
  scrollTrigger:{
  trigger:".banniere",
 

  toggleActions : "play none none none",
  start: "25% 70%",
  
  },
opacity:0,
y:200,

duration:1.5,
ease: "power2.out",


});

// const swup = new Swup(); 
// const swup = new Swup();
