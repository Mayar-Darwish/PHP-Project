const products_div = document.getElementById("products");
const order_div = document.getElementById("order");
const add_product = document.getElementById("add_product");
let products = [];
totalPriceSection = document.getElementById("totalPrice");
let product_container = ``;
let OrdertotalPrice;
 
function displayOrder() {
     OrdertotalPrice = 0;
    product_container = ``;
    for (let i = 0; i < products.length; i++) {
        product_container += `
            <th scope="row" id=product-${products[i].id}> ${products[i].id} </th>
                <td>${products[i].name}</td>
                <td>
                    <div class='d-flex justify-content-between align-items-center'>
                        <div>
                            <a class='btn btn-warning  mx-1' id="decreaseQuntID" onclick='decreaseOrderQuantity(${i})'>-</a>
                        </div>
                        <div>
                            ${products[i].quantity}
                        </div>
                        <div>
                            <a class='btn btn-success mx-1' onclick='increaseOrderQuantity(${i})'>+</a>
                        </div>     
                           <div>
                            <a class='btn btn-danger mx-3' onclick='deleteOrderFromProduct(${i})'>D</a>
                        </div>                      
                    </div>
                </td>
                <td>${products[i].totalPrice}  </td>
                
            </tr>
        `;
   

      OrdertotalPrice += Number(products[i].totalPrice);
 
    }

  add_product.innerHTML = product_container;
   totalPriceSection.innerHTML= `<div>${OrdertotalPrice} EGP</div>`;
}


function increaseOrderQuantity(productIndex) {

  products[productIndex].quantity++;
  products[productIndex].totalPrice =
    products[productIndex].quantity * products[productIndex].price;
  displayOrder();
 
}

function decreaseOrderQuantity(productIndex) {
 
  products[productIndex].quantity--;
  if (products[productIndex].quantity <= 1) {
   
     products[productIndex].quantity =1;
    
  }
  else {
     products[productIndex].totalPrice -= products[productIndex].price; 
    
  }
  
    displayOrder();
 

}

function deleteOrderFromProduct(productIndexx) {
  console.log(productIndexx);
  console.log(products);
  
    products.splice(productIndexx, 1);
    console.log(products);
    displayOrder();
}



function add_order(orderID) {
  console.log("in addd order");
    
  fetch(
    `http://localhost/ITI-PHP-Course/PHP-Project/fetchProduct.php?id=${orderID}`
  ).then(async (data) => {
    data = await data.json();
    let product = data["product"];
    product["totalPrice"] = product["price"];

    for (let i = 0; i < products.length; i++) {
      console.log(products[i]);
      if (products[i].id === product.id) {

        increaseOrderQuantity(i);

        displayOrder();
        return;
      }
    }
    product.quantity = 1;
    products.push(product);
    displayOrder();
  });
     
   
}


async function sendData() {
  room = document.getElementById("roomNo").value;
  note = document.getElementById("notes").value;
  let order = {
    products: products,
    room: room,
    note: note,
    OrdertotalPrice,OrdertotalPrice
  };

  fetch("add_order.php", {
    method: "POST",
    body: JSON.stringify(order),
    headers: {
      "Content-Type": "application/json; charset=UTF-8",
    },
  })
    .then((response) => response.json())
    .then((data) => console.log(data));
}

