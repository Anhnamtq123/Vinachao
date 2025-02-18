@extends('admin.master')

@section('container')

<div class="card">
  <div class="card-header">
      <div class="card-title">Thêm sản phẩm</div>
  </div>
  <div class="card-body">
    <form action="{{route('product.store')}}" method="POST" enctype="multipart/form-data">
        @csrf 
        <div class="mb-3">
          <label for="name" class="form-label">name</label>
          <input type="text" class="form-control" id="name" name="name" placeholder="Nhập tên">
        </div>
        <div class="mb-3">
          <label for="price" class="form-label">Giá</label>
          <input type="number" class="form-control" name="price" id="price" placeholder="Nhập giá">
        </div>
        <div class="mb-5 d-flex justify-content-center">
                <img id="selectedImage" src="./assets/img/default.jpg"alt="example placeholder" style="width: 300px;" />  
        </div>
        <div class="mb-3">
            <div class="d-flex justify-content-center">
                <div data-mdb-ripple-init class="btn btn-primary btn-rounded">
                    <label class="form-label text-white m-1" for="img">Thêm ảnh</label>
                    <input type="file" class="form-control d-none" name="img" id="img" onchange="displaySelectedImage(event, 'selectedImage')" />
                </div>
            </div>
        </div>
        <label for="descriptions" class="mb-3 d-flex justify-content-center form-label">Mô tả</label>
        <div class="mb-3 d-flex justify-content-center">
            <div class="d-flex justify-content-center">
                <textarea name="descriptions" id="" cols="30" rows="10"></textarea>
            </div>
        </div>
        <div class="mb-3 d-flex justify-content-center">
            <button type="submit" class="btn btn-primary">Thêm</button>
        </div>
        
    </form>
</div>
</div>

<script>
function displaySelectedImage(event, elementId) {
  const selectedImage = document.getElementById(elementId);
  const fileInput = event.target;

  if (fileInput.files && fileInput.files[0]) {
      const reader = new FileReader();

      reader.onload = function(e) {
          selectedImage.src = e.target.result;
      };

      reader.readAsDataURL(fileInput.files[0]);
  }
}
</script>

@endsection