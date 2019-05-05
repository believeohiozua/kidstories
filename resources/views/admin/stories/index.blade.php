@extends('admin.layouts.app', ['title' => __('Manage Stories')])

@section('content')
    @include('admin.layouts.headers.cards')

    <div class="container-fluid mt--7">
        <div class="row">
            <div class="col">
                <div class="card shadow">
                    <div class="card-header border-0">
                        <div class="row align-items-center">
                            <div class="col-8">
                                <h3 class="mb-0">{{ __('Stories') }}</h3>
                            </div>
                            <div class="col-4 text-right">
                                <a href="{{ route('stories.create') }}" class="btn btn-sm btn-primary">{{ __('Add story') }}</a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12">
                        @if (session('status'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('status') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                    </div>

                    <div class="table-responsive">
                        <table class="table align-items-center table-flush">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">{{ __('Title') }}</th>
                                    <th scope="col">{{ __('Story') }}</th>
                                    <th scope="col">{{ __('Category') }}</th>
                                    <th scope="col">{{ __('Image Url') }}</th>
                                    <th scope="col">{{ __('Image Name') }}</th>
                                    <th scope="col">{{ __('Age') }}</th>
                                    <th scope="col">{{ __('Author') }}</th>                                   
                                    <th scope="col">{{ __('story duration') }}</th>
                                    <th scope="col">{{ __('Premium') }}</th>                         
                                    <th scope="col">{{ __('user id') }}</th>
                                    <th scope="col">{{ __('Created') }}</th>
                                    <th scope="col">{{ __('Updated') }}</th>
                                    <th scope="col"></th>
                                </tr>                         
                            </thead>
                           
                             <tbody>
                                @foreach ($stories as $story)
                                    <tr>
                                        <td>{{ $story->title}}</td>
                                         <td>{{ $story->body }}</td>
                                         <td>{{ $story->category_id }}</td>                                     
                                        <td>
                                            @if ($story->image_url)
                                                <a href="{{ $story->image_url }}" target="_blank">View image</a>                                          
                                            @endif
                                        </td> 
                                       <td>{{ $story->image_name}}</td>
                                       <td>{{ $story->age_from}} - {{ $story->age_to}}</td>
                                       <td>{{ $story->author }}</td>                                      
                                       <td>{{ $story->story_duration }}</td>
                                       <td>{{ $story->is_premium}}</p></td> 
                                       <td>{{ $story->user_id}}</td>                                                                      
                                      <td><{{ $story->created_at->format('d/m/Y @ h:i a') }}</td>
                                      <td><{{ $story->updated_at->format('d/m/Y @ h:i a') }}</td>
                                        <td class="text-right">
                                            <div class="dropdown">
                                                <a class="btn btn-sm btn-icon-only text-light" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                    
                                                    <form action="{{ route('stories.destroy', $story->id) }}" method="post">
                                                        @csrf
                                                        @method('delete')
                                                        
                                                        <a class="dropdown-item" href="{{ route('stories.edit', $story->id) }}">{{ __('Edit') }}</a>
                                                        <button type="button" class="dropdown-item" onclick="confirm('{{ __("Are you sure you want to delete?") }}') ? this.parentElement.submit() : ''">
                                                            {{ __('Delete') }}
                                                        </button>
                                                    </form>                                                        
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="card-footer py-4">
                        <nav class="d-flex justify-content-end" aria-label="...">
                                <div>
            {{  $stories->links()  }}
        </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
     
            
        @include('admin.layouts.footers.auth')
    </div>
@endsection