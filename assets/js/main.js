window.addEventListener('load', ()=>
{

    function checkIfFormExistUsingClassName(formName) {
        
        let result = document.getElementsByClassName(formName).length > 0;

        if (result) {
            return true;
        }

        return false;

    }

    let subImgCntir = document.querySelectorAll(".item");

    subImgCntir.forEach( (item)=>
    {

        item.addEventListener("click", ()=>
        {

            let hImg = item.querySelector("img");


            let hLink = hImg.getAttribute("src");

            let hero_image_container = document.querySelector(".hero-image");
            let hero_image_container_image = hero_image_container.querySelector("img");

            hero_image_container_image.setAttribute("src", hLink);

        });

    } );

  if ( checkIfFormExistUsingClassName( "responsive-icon" ) === true )
  {

    document.querySelector(".responsive-icon").addEventListener("click", ()=> {

        Lock();
    });

    function Lock()
    {
        document.querySelector(".links-and-icon-container").classList.add("ui-search-modal-small-slide-in");

        let cont = document.querySelector(".links-and-icon-container");

        cont.querySelector(".ui-close").addEventListener("click", ()=>{

            document.querySelector(".links-and-icon-container").classList.add("ui-search-modal-small-slide-out");

            setTimeout(() => {
                document.querySelector(".links-and-icon-container").classList.remove("ui-search-modal-small-slide-in");
                document.querySelector(".links-and-icon-container").classList.remove("ui-search-modal-small-slide-out");
            }, 1000);
            
        });

        

    }

  }




});


