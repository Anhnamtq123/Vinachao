@extends('admin.master')
@section('container')

<div class="card-body">
  <!-- Modal -->
  <div
    class="modal fade"
    id="addRowModal"
    tabindex="-1"
    role="dialog"
    aria-hidden="true"
  >
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header border-0">
          <h5 class="modal-title">
            <span class="fw-mediumbold"> New</span>
            <span class="fw-light"> Row </span>
          </h5>
          <button
            type="button"
            class="close"
            data-dismiss="modal"
            aria-label="Close"
          >
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p class="small">
            Create a new row using this form, make sure you
            fill them all
          </p>
          <form>
            <div class="row">
              <div class="col-sm-12">
                <div class="form-group form-group-default">
                  <label>Name</label>
                  <input
                    id="addName"
                    type="text"
                    class="form-control"
                    placeholder="fill name"
                  />
                </div>
              </div>
              <div class="col-md-6 pe-0">
                <div class="form-group form-group-default">
                  <label>Position</label>
                  <input
                    id="addPosition"
                    type="text"
                    class="form-control"
                    placeholder="fill position"
                  />
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group form-group-default">
                  <label>Office</label>
                  <input
                    id="addOffice"
                    type="text"
                    class="form-control"
                    placeholder="fill office"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
        <div class="modal-footer border-0">
          <button
            type="button"
            id="addRowButton"
            class="btn btn-primary"
          >
            Add
          </button>
          <button
            type="button"
            class="btn btn-danger"
            data-dismiss="modal"
          >
            Close
          </button>
        </div>
      </div>
    </div>
  </div>

  <div class="table-responsive">
    <table
      id="add-row"
      class="display table table-striped table-hover"
    >
      <thead>
        <tr>
          <th>Avatar</th>
          <th>Name</th>
          <th>Price</th>
          <th style="width: 10%">Update/Delete</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th>Avatar</th>
          <th>Name</th>
          <th>Price</th>
          <th style="width: 10%">Update/Delete</th>
        </tr>
      </tfoot>
      <tbody>
        @foreach ($products as $product)
        <tr>
          @if ($product->img == "")
          <td>
            <div class="avatar">
                <img src="./uploads/default.jpg" alt="..." class="avatar-img rounded">
            </div>
        </td>
          @else
          <td>
            <div class="avatar">
                <img src="./uploads/{{$product->img}}" alt="..." class="avatar-img rounded">
            </div>
        </td>
          @endif
          <td>{{$product->name}}</td>
          <td>{{$product->price}}</td>
          <td>
            <form action="{{route('product.destroy',$product->id)}}" method="post">
              @csrf @method('DELETE')
              <div class="form-button-action">
                <a
                  href ="{{route('product.edit',$product->id)}}"
                  data-bs-toggle="tooltip"
                  title=""
                  class="btn btn-link btn-primary btn-lg"
                  data-original-title="Edit Task"
                >
                  <i class="fa fa-edit"></i>
                </a>
                <form action="{{ route('product.destroy', $product->id) }}" method="POST" style="display: inline-block;">
                  @csrf
                  @method('DELETE') <!-- Mô phỏng phương thức DELETE -->
                  <button type="submit" data-bs-toggle="tooltip" title="" class="btn btn-link btn-danger" data-original-title="Remove">
                    <i class="fa fa-times"></i>
                  </button>
                </form>
            </form>
            </div>
          </td>
        </tr> 
        @endforeach
        
      </tbody>
    </table>
  </div>
</div>

@stop 
