@extends('app.bootstrap.template')

@section('modalcontent')

<div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="createModalLabel">Crear peinado</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form>
            <div class="espacio">
                <label for="author">Author:</label>
                <input class="form-control" minlength="1" maxlength="60" id="author" placeholder="Author of the hairstyle" value="" type="text">
            </div>
            <div class="espacio">
                <label for="name">Name:</label>
                <input class="form-control" minlength="3" maxlength="100" id="name" placeholder="Name of the hairstyle" value="" type="text">
            </div>
            <div class="espacio">
                <label for="idpelo">Type of hair</label>
                <input class="form-control" minlength="3" maxlength="110" id="idpelo" placeholder="Type of hair for the hairstyle" value="" type="text">
            </div>
            <div class="espacio">
                <label for="description">Description of the hairstyle</label>
                <textarea class="form-control" minlength="50" id="description" placeholder="Description of the hairstyle" cols="60" rows="8" ></textarea>
            </div>
            <div class="espacio">
                <label for="price">Price of the hairstyle</label>
                <input class="form-control" step="0.01" min="-1" max="999999.99" id="price" placeholder="Price of the hairstyle" value="" type="number">
            </div>
            <div class="espacio">
                <input class="btn btn-primary" value="Add new hairstyle" type="button" id="btSubmitPeinado">
            </div>
        </form>
      </div>
    </div>
  </div>
</div>

@endsection

@section('content')

<div id="spa"></div>

<script>
    const padre = document.getElementById('spa');
    const hijo = document.createElement('button');
    hijo.classList.add('btn', 'btn-secondary', 'mb-2');
    hijo.dataset.bsToggle = 'modal';
    hijo.dataset.bsTarget = '#createModal';
    //hijo.setAttribute('data-bs-toggle', 'modal');
    const textNode = document.createTextNode('Crear peinado');
    hijo.appendChild(textNode);
    padre.appendChild(hijo);

    const btSubmitPeinado = document.getElementById('btSubmitPeinado');
    btSubmitPeinado.addEventListener('click', async (e) => {
        const json = await fetchCreatePeinado();
        console.log(json.success);
        if(json.success == true) {
            const modalElement = document.getElementById('createModal');
            const modal = bootstrap.Modal.getInstance(modalElement);
            modal.hide();
        } else {
            alert('Mal');
        }
    });
    const fetchCreatePeinado = async () => {
        const author = document.getElementById('author');
        const name = document.getElementById('name');
        const idpelo = document.getElementById('idpelo');
        const description = document.getElementById('description');
        const price = document.getElementById('price');
        const peinado = {
            author: author.value,
            name: name.value,
            idpelo: idpelo.value,
            description: description.value,
            price: price.value
        };
        const res = await fetch('https://dwes.hopto.org/laraveles/barberApp/public/api/peinado', {
            headers: {
                'content-type': 'application/json',
                'accept': 'application/json'
            },
            method: 'post',
            body: JSON.stringify(peinado)
        });
        const data = await res.json();
        console.log(data);
        return data;
    };
</script>

@endsection