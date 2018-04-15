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
Route::get('/atendimento_usuario', 'HomeController@atendimento_usuario')->name('atendimento_usuario');

Route::get('/dashboard', 'DashboardController@home')->name('home');
Route::get('/dashboard/atendimento/{id}', 'DashboardController@atendimento');

//Utilizador 
Route::get('/utilizador/remover_alerta/{id}', 'UtilizadorController@remover_alerta');


//Chatbot
Route::group(['prefix' => 'chatbot'], function() {  
    Route::get('listar_topicos_ajax', 'ChatbotController@listar_topicos_ajax')->name('chatbot.listar_topicos_ajax');
    Route::get('configuracoes', 'ChatbotController@configuracoes')->name('chatbot.configuracoes');
    Route::get('listar_perguntas_respostas_ajax', 'ChatbotController@listar_perguntas_respostas_ajax');
    Route::get('listar_topicos', 'ChatbotController@listar_topicos')->name('chatbot.listar_topicos');
    Route::get('adicionar_palavra_chave_pergunta', 'ChatbotController@adicionar_palavra_chave_pergunta')->name('chatbot.adicionar_palavra_chave_pergunta');
    Route::get('editar_palavra_chave_pergunta/{id}', 'ChatbotController@editar_palavra_chave_pergunta');
    Route::get('excluir_palavra_chave_pergunta/{id}', 'ChatbotController@excluir_palavra_chave_pergunta');
    Route::post('p_adicionar_palavra_chave_pergunta', 'ChatbotController@p_adicionar_palavra_chave_pergunta')->name('chatbot.p_adicionar_palavra_chave_pergunta');
});

Route::post('chatbot_dialog/obter_resposta_ajax', 'ChatbotDialogController@obter_resposta_ajax')->name('chatbotdialog.obter_resposta_ajax');

