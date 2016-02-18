<div class="post">
	
	<div class="post_header">
		<div class="thumbnail thumb-sm post_header">
			<img src="{{ $post->author->person->image() }}" alt=" {{ $post->author->person->image() }} ">
		</div>

		<div class="post_header_details">
			<div class="post_author"><a href="{{ route('people.show', $post->author->person->id) }}"> {{ $post->author->person->name() }} </a></div>
			<div class="post_datetime"> {{ $post->date("created_at") }} </div>
			@if (Route::getCurrentRoute()->getPath() == 'tickets/{id}')
				<div class="post_details">
					<a href="{{ route('posts.show', $post->id) }}"> Details </a>
				</div>
			@endif
		</div>

	</div>

	<div class="post_content"> {!! $post->post !!} </div>
	
	<div class="post_attachments">
		<div class="row">

			@foreach ($post->attachments as $attachment)
				<div class="col-xs-3 col-ms-2 col-sm-2 col-md-1 col-lg-1">
					<a href="{{ $attachment->path() }}" class="thumbnail" @if ($attachment->is_image()) data-gallery @endif>
						<img src="{{ $attachment->thumbnail() }}" alt="...">
					</a>
				</div>
			@endforeach

		</div>
	</div>

</div>
