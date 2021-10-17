
// USER MENU
const accountPic = document.querySelector('#user-menu-button');
const accountPicMenu = document.querySelector('#user-menu');
// focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white
if (accountPic) {
  // hover on
  accountPic.addEventListener('mouseover', () => {
    accountPicMenu.classList.remove('hidden');
    accountPic.classList.add('outline-none','ring-2','ring-offset-2','ring-offset-gray-800','ring-white');
  });
  // hover off
  accountPicMenu.addEventListener('mouseleave', () => {
    //e.target.classList.add('hidden');
    accountPicMenu.classList.add('hidden');
    accountPic.classList.remove('outline-none','ring-2','ring-offset-2','ring-offset-gray-800','ring-white');
  });
  // click event while hover
  accountPic.addEventListener('click', () => {
    if (accountPicMenu.classList.contains('hidden')) {
      accountPicMenu.classList.remove('hidden');
      accountPic.classList.add('outline-none','ring-2','ring-offset-2','ring-offset-gray-800','ring-white');
    } else {
      accountPicMenu.classList.add('hidden');
      accountPic.classList.remove('outline-none','ring-2','ring-offset-2','ring-offset-gray-800','ring-white');
    }
  });
  // loose focus
  accountPic.addEventListener('focusout', () => {
    if (!accountPicMenu.classList.contains('hidden')) {
      accountPicMenu.classList.add('hidden');
      accountPic.classList.remove('outline-none','ring-2','ring-offset-2','ring-offset-gray-800','ring-white');
    } 
  });
}


// accountPic.addEventListener('focusout', () => {
//   accountPicMenu.classList.add('hidden');
// });
// MOBILE MENU
const mobileMenu = document.querySelector('#mobile-menu');
const mobileMenuButton = document.querySelector('#mobile-menu-button');
const mobileMenuHamb = document.querySelector('#mobile-menu-icon-hamb');
const mobileMenuCross = document.querySelector('#mobile-menu-icon-cross');

mobileMenuButton.addEventListener('click', () => {
  mobileMenu.classList.toggle('hidden');
  if (mobileMenu.classList.contains('hidden')) {
    mobileMenuHamb.classList.add('block');
    mobileMenuHamb.classList.remove('hidden');
    mobileMenuCross.classList.remove('block');
    mobileMenuCross.classList.add('hidden');
  } else {
    mobileMenuHamb.classList.remove('block');
    mobileMenuHamb.classList.add('hidden');
    mobileMenuCross.classList.add('block');
    mobileMenuCross.classList.remove('hidden');
  }
});

// FETCHING DATA front page
function topCoins() {
  const Http_topCoins = new XMLHttpRequest();
  const url_topCoins = 'https://api.coingecko.com/api/v3/coins/markets?vs_currency=usd&order=market_cap_desc&per_page=10&page=1';
  Http_topCoins.open("GET", url_topCoins);
  Http_topCoins.send();

  Http_topCoins.onreadystatechange = function() {
    if(this.readyState==4 && this.status==200){ // checks if request complete and successful
      printTopCoins(Http_topCoins.responseText)
    }
  }

  function printTopCoins(e) {
    topCoinsArray = JSON.parse(e);
    // console.log(topCoinsArray[0]);
    for (let i = 0; i < topCoinsArray.length; i++) {
      let num = i + 1;
      let name = topCoinsArray[i].name;
      let pic = topCoinsArray[i].image;
      let price = topCoinsArray[i].current_price;
      let change = topCoinsArray[i].price_change_percentage_24h;

      let td_image = document.getElementById("topCoinPic-"+num);
      let td_name = document.getElementById("topCoinName-"+num);
      let td_price = document.getElementById("topCoinPrice-"+num);
      let td_change = document.getElementById("topCoinChange-"+num);
      
      td_image.innerHTML = "<img class=\"w-7\" src=\""+pic+"\" />";
      td_name.innerHTML = name;
      td_price.innerHTML = "$"+price;
      td_change.innerHTML = change+"%";
    } 
  }
}

function drawLineChart() {
  const data = {
    labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
    datasets: [{
      label: 'My First Dataset',
      data: [65, 59, 80, 81, 56, 55, 40],
      fill: false,
      borderColor: 'rgb(75, 192, 192)',
      tension: 0.1
    }]
  };
  const config = {
    type: 'line',
    data: data,
  };
  var myChart = new Chart(
    document.getElementById('lineChart'),
    config
  );
}

function drawdoughChart() {
  const data = {
    labels: ['Red', 'Blue', 'Yellow'],
    datasets: [{
      label: 'My First Dataset',
      data: [300, 50, 100],
      backgroundColor: [
        'rgb(255, 99, 132)',
        'rgb(54, 162, 235)',
        'rgb(255, 205, 86)'
      ],
      hoverOffset: 4
    }]
  };
  const config = {
    type: 'doughnut',
    data: data,
  };
  var myChart = new Chart(
    document.getElementById('doughChart'),
    config
  );
}


// Signup Form
function check_pwd() {
    if (document.getElementById('pwd').value == document.getElementById('pwdrepeat').value) {
        document.getElementById('submit').disabled = false;
        // style changes
        document.getElementById('pwdrepeat_lock').style.color = 'rgba(52, 211, 153, 1)'; // green https://tailwindcss.com/docs/background-color
        document.getElementById('pwdrepeat').style.color = 'rgba(52, 211, 153, 1)';
    } else {
        document.getElementById('submit').disabled = true;
        // style changes
        document.getElementById('pwdrepeat_lock').style.color = 'rgba(248, 113, 113, 1)'; // red
        document.getElementById('pwdrepeat').style.color = 'rgba(248, 113, 113, 1)';
    }
}


// Portfolio Search MODAL
var openmodal = document.querySelectorAll('.modal-open')
    for (var i = 0; i < openmodal.length; i++) {
      openmodal[i].addEventListener('click', function(event){
    	event.preventDefault()
    	toggleModal()
      })
    }
    const overlay = document.querySelector('.modal-overlay')
    overlay.addEventListener('click', toggleModal)
    
    var closemodal = document.querySelectorAll('.modal-close')
    for (var i = 0; i < closemodal.length; i++) {
      closemodal[i].addEventListener('click', toggleModal)
    }
    document.onkeydown = function(evt) {
      evt = evt || window.event
      var isEscape = false
      if ("key" in evt) {
    	isEscape = (evt.key === "Escape" || evt.key === "Esc")
      } else {
    	isEscape = (evt.keyCode === 27)
      }
      if (isEscape && document.body.classList.contains('modal-active')) {
    	toggleModal()
      }
    };
    function toggleModal () {
      const body = document.querySelector('body')
      const modal = document.querySelector('.modal')
      modal.classList.toggle('opacity-0')
      modal.classList.toggle('pointer-events-none')
      body.classList.toggle('modal-active')
    }


// Search ADD coins on profile page MODAL
function searchAddCoins() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}

// Trades TABLE
function changeAtiveTab(event,tabID,tabType){
  if (tabType == "buy") {
    buyButton = document.getElementById("buy");
    buyButton.className = 'text-white bg-green-600 text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal cursor-pointer';
    sellButton = document.getElementById("sell");
    sellButton.className = 'text-red-600 bg-white text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal cursor-pointer';
  }
  if (tabType == "sell") {
    sellButton = document.getElementById("sell");
    sellButton.className = 'text-white bg-red-600 text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal cursor-pointer';
    buyButton = document.getElementById("buy");
    buyButton.className = 'text-green-600 bg-white text-xs font-bold uppercase px-5 py-3 shadow-lg rounded block leading-normal cursor-pointer';
  }
  let element = event.target;
  while(element.nodeName !== "A"){
    element = element.parentNode;
  }
  ulElement = element.parentNode.parentNode;
  aElements = ulElement.querySelectorAll("li > a");
  tabContents = document.getElementById("tabs-id").querySelectorAll(".tab-content > div");
  for(let i = 0 ; i < aElements.length; i++){
    tabContents[i].classList.add("hidden");
    tabContents[i].classList.remove("block");
  }
  document.getElementById(tabID).classList.remove("hidden");
  document.getElementById(tabID).classList.add("block");
}