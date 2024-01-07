<select {!! $attributes->merge([
    'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm',
]) !!}>
    <option value="">Select {{ $header }}</option>
    @foreach ($data as $d)
        <option value="{{ $d->id }}" {{ $value == $d->id ? 'selected' : '' }}>{{ $d->name }}</option>
    @endforeach
</select>

