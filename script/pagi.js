document.addEventListener('DOMContentLoaded', () =>{

    const back = document.getElementsByClassName("btn-back")[0];
    const numb = document.getElementsByClassName("btn-numb")[0];
    const next = document.getElementsByClassName("btn-next")[0];
    const nutr = document.getElementsByTagName("tr");
    var activeindex = 0;

    function changepage(array,findex) {
        var baseindex = 0;
        if (findex <= 0) {
            baseindex = 0;
            findex = 0;
        } else if(findex>array.length || findex > (array.length - 12)) {
            baseindex = array.length - 12;
            findex = array.length - 12;
            console.log("pass max");
        } else {
            baseindex = findex;
        }
        for (let index = 0; index < array.length; index++) {
            if (index == findex) {
                array[index].style.fontfamily = "sans-serif";
                array[index].style.fontsize = "1.5vw";
                array[index].style.visibility = "visible";
                if (findex<(baseindex+12)) {
                    findex++;
                }
            } else {
                if (index == 0) {
                    array[index].style.fontfamily = "sans-serif";
                    array[index].style.fontsize = "1.5vw";
                    array[index].style.visibility = "visible";
                } else {
                array[index].style.visibility = "collapse";
                }
            }
        }
    }

    back.addEventListener("click",()=>{
        if ((activeindex - 12) < 0) {
            activeindex = 0;
            changepage(nutr,activeindex);
        } else {
            activeindex -= 12;
            changepage(nutr,activeindex);
        }
    });

    numb.disabled = true;

    next.addEventListener("click",()=>{
        if ((activeindex + 12) >= nutr.length) {
            activeindex = nutr.length - 12;
            changepage(nutr,activeindex);
        } else {
            console.log('else next');
            activeindex += 12;
            changepage(nutr,activeindex);
        }
    });

    changepage(nutr,activeindex);
});