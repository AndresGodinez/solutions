<input type="hidden" name='valid' id="valid" value="{{ $response['valid'] }}">
<input type="hidden" name='message' id="message" value="{{ $response['message'] }}">

@if($response['valid'])
    <input type="hidden" name='np_description' id="np_description" value="{{ $response['np_description'] }}">
@endif
