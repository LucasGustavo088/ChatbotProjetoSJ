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
Route::get('/dashboard/listar_pendencias_ajax', 'DashboardController@listar_pendencias_ajax');

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

//Chatbot dialog
Route::post('chatbot_dialog/obter_resposta_ajax', 'ChatbotDialogController@obter_resposta_ajax')->name('chatbotdialog.obter_resposta_ajax');
Route::post('chatbot_dialog/salvar_atendimento', 'ChatbotDialogController@salvar_atendimento')->name('chatbotdialog.salvar_atendimento');
Route::get('/chatbot_dialog/carregar_mensagens_chat/{id_atendimento}', 'ChatbotDialogController@carregar_mensagens_chat');
Route::get('/chatbot_dialog/salvar_mensagem_banco/{pergunta_ou_resposta}/{id_atendimento}', 'ChatbotDialogController@salvar_mensagem_banco');
Route::post('/chatbot_dialog/atualizar_status_atendimento', 'ChatbotDialogController@atualizar_status_atendimento');
Route::post('/chatbot_dialog/resposta_satisfatoria', 'ChatbotDialogController@resposta_satisfatoria');

Route::get('/relatorio/listar_pendencias', 'RelatorioController@listar_pendencias')->name('relatorio.listar_pendencias');

//Relatório
Route::group(['prefix' => 'relatorio'], function() {  
    Route::post('gerar_relatorio', 'RelatorioController@gerar_relatorio')->name('relatorio.gerar_relatorio');
});

