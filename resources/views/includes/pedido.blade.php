@if (session('pedido'))
                        <div class="alert alert-success alert-dismissible">
                        	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            {{ session('pedido') }}
                        </div>
@endif