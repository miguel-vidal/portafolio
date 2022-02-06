
//opcion es para el switch, 
//data es el formdata, 
//param por si queremos un parametro
function format_json(option,data='', param=''){

    let formdata='', json_format=null, out=null; 
    switch(option){
        case 1:
            formdata=new FormData(data);
            json_format=Array.from(formdata.entries()).reduce((memo, pair) => ({
            ...memo,
            [pair[0]]: pair[1],
          }), {});
         out=JSON.stringify(json_format);
        break;
        case 2: 
        formdata=new FormData();
        formdata.append(`${param}`,param)
        json_format=Array.from(formdata.entries()).reduce((memo, pair) => ({
        ...memo,
        [pair[0]]: pair[1],
      }), {});
        out=JSON.stringify(json_format);
        break;
        case 3:
        formdata=new FormData();
        formdata.append('id',param)
        json_format=Array.from(formdata.entries()).reduce((memo, pair) => ({
        ...memo,
        [pair[0]]: pair[1],
      }), {});
        out=JSON.stringify(json_format);
        break;
    }
    return out;
}


