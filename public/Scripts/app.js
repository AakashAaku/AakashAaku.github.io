const login = () => {
    const username = document.querySelector('#username').value;
    const password = document.querySelector('#password').value;
  
    if (username === 'user' && password === 'pass') {
      // call the navigator to move to the new page
      const navigator = document.querySelector('#navigator');
      navigator.resetToPage('home.html');
    } else {
      ons.notification.alert('Wrong username/password combination');
    }
  }


  function openNewRegister() {
    document.querySelector('#myNavigator').pushPage('Pages/new_register.html');
  }

  function openPending(){
    document.querySelector('#myNavigator').pushPage('Pages/pending_luggage.html');
  }

  function openComplated(){
    document.querySelector('#myNavigator').pushPage('Pages/completed_luggage.html');
  }

  function openFrequent(){
    document.querySelector('#myNavigator').pushPage('Pages/frequent_luggage.html');
  }

// function goToNew(){
//   document.addEventListener('init', function(event) {
//     var page = event.target;

//    if (page.id === 'pending_luggage') {
//      page.querySelector('#goToNew').onclick = function() {
//       document.querySelector('#myNavigator').pushPage('new_register.html', {data: {title: 'Page 2'}});
//     };
//   } else if (page.id === 'page2') {
//   page.querySelector('ons-toolbar .center').innerHTML = page.data.title;
// }
// });
// }
class RemoteAPI{


  // var url= 'https://pokeapi.co/api/v2/pokemon';
  // var nextNum=1;

 fetchAutoRegNum () {
  
  }


   get = async()=>{

    var url= 'https://pokeapi.co/api/v2/pokemon';
    var nextNum=1;
     const response = await fetch(url);
     const json = await response.json();
     const regNum = json.result.map(e=>e.reg_user_id);

     const userList = document.querySelector('#infinite-list')
     regNum.forEach(id=>{
        userList.appendChild(ons.createElement(
           `<ons-list-item expandable>
                ${nextNum} ${id}
                <div class="expandable-content">
                    <ons-button onclick="gotToNew(${nextNum},
                      this)">+</ons-button>
                </div>
           </ons-list-item>`
        ));
        nextNum++;
     });

     url=json.next;

  }

}