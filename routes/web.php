<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();
//Auth
Route::get('/auth/logout', 'Auth\LogoutController@logout')->name('logout');

Route::get('/', 'HomeController@index')->name('home');
Route::get('/dashboard', 'DashboardController@home')->name('home');
Route::get('/dashboard/atendimento', 'DashboardController@atendimento')->name('atendimento');

Route::group(['prefix' => 'chatbot'], function() {  
    Route::get('listar_perguntas_respostas', 'ChatbotController@listar_perguntas_respostas')->name('chatbot.listar_perguntas_respostas');
    Route::get('configuracoes', 'ChatbotController@configuracoes')->name('chatbot.configuracoes');
    Route::get('listar_perguntas_respostas_ajax', 'ChatbotController@listar_perguntas_respostas_ajax');
    Route::get('adicionar_palavra_chave_pergunta', 'ChatbotController@adicionar_palavra_chave_pergunta')->name('chatbot.adicionar_palavra_chave_pergunta');
    Route::post('p_adicionar_palavra_chave_pergunta', 'ChatbotController@p_adicionar_palavra_chave_pergunta')->name('chatbot.p_adicionar_palavra_chave_pergunta');
});


