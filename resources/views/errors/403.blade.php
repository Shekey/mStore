@extends('errors::illustrated-layout')

@section('title', __('Neautorizovan pristup'))
@section('code', '403')
@section('message', __($exception->getMessage() ?: 'Nemate pristup'))
