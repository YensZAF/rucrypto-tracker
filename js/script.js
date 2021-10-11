
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
      let id = topCoinsArray[i].id;
      let symbol = topCoinsArray[i].symbol;
      let price = topCoinsArray[i].current_price;
      let change = topCoinsArray[i].price_change_percentage_24h;

      let td_id = document.getElementById("topCoinID-"+num);
      let td_name = document.getElementById("topCoinName-"+num);
      let td_price = document.getElementById("topCoinPrice-"+num);
      let td_change = document.getElementById("topCoinChange-"+num);
      
      td_id.innerHTML = symbol;
      td_name.innerHTML = id;
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
