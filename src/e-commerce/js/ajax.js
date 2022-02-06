
const ajax=request=>{

    return new Promise((resolve,reject)=>{

        let xhr=new XMLHttpRequest();
        xhr.open(request.method, request.url);

        xhr.onload=()=>{

            resolve(xhr);
        }

        xhr.setRequestHeader( 'Content-Type', 'application/json' );

        
        request.data != '' 
        ? xhr.send(request.data) 
        : xhr.send();

        
    });
}



const formdata=request=>{

    return new Promise((resolve,reject)=>{

        let xhr=new XMLHttpRequest();
        xhr.open(request.method, request.url);

        xhr.onload=()=>{

            resolve(xhr);
        }
                

        xhr.send(request.data);
    });
}
