document.addEventListener('DOMContentLoaded', async function() {
    
    // Capturando os selects e inputs
    const selectModelo = document.querySelector('select[name="modelo"]');
    const selectVersao = document.querySelector('select[name="versao"]');
    const inputMotor = document.querySelector('input[name="motorizacao"]');
    const inputPotencia = document.querySelector('input[name="potencia"]');
    const inputAceleracao = document.querySelector('input[name="aceleracao"]');
    const inputTransmissao = document.querySelector('input[name="transmissao"]');
    const inputCombustivel = document.querySelector('[name="combustivel"]');

    // Função auxiliar para limpar a ficha técnica
    function limparEspecificacoes() {
        inputMotor.value = '';
        inputPotencia.value = '';
        inputAceleracao.value = '';
        inputTransmissao.value = '';
        inputCombustivel.value = '';
    }

    try {
        // 1. O JS faz o request do arquivo JSON externo!
        const resposta = await fetch('assets/json/catalog.json');
        // Verifica se o caminho do arquivo está correto
        if (!resposta.ok) throw new Error('Falha ao carregar o JSON');
        
        // Converte a resposta para objeto JavaScript
        const catalogoBMW = await resposta.json();

        // 2. Preenche o select de Séries
        for (const serie in catalogoBMW) {
            const option = document.createElement('option');
            option.value = serie;
            option.textContent = serie;
            selectModelo.appendChild(option);
        }

        // 3. Regra ao mudar a Série
        selectModelo.addEventListener('change', function() {
            const serieEscolhida = this.value;
            
            selectVersao.innerHTML = '<option value="">Selecione uma versão</option>';
            limparEspecificacoes();

            if (serieEscolhida && catalogoBMW[serieEscolhida]) {
                const versoes = catalogoBMW[serieEscolhida];
                
                for (const versao in versoes) {
                    const option = document.createElement('option');
                    option.value = versao;
                    option.textContent = versao;
                    selectVersao.appendChild(option);
                }
            }
        });

        // 4. Regra ao mudar a Versão (Preencher ficha técnica)
        selectVersao.addEventListener('change', function() {
            const serieEscolhida = selectModelo.value;
            const versaoEscolhida = this.value;

            if (serieEscolhida && versaoEscolhida && catalogoBMW[serieEscolhida][versaoEscolhida]) {
                const specs = catalogoBMW[serieEscolhida][versaoEscolhida];
                
                inputMotor.value = specs.motorizacao || '';
                inputPotencia.value = (specs.potencia && specs.torque) 
                    ? `${specs.potencia} / ${specs.torque}` : '';
                inputAceleracao.value = specs.aceleracao || '';
                inputTransmissao.value = specs.transmissao || '';
                inputCombustivel.value = specs.combustivel || '';
            } else {
                limparEspecificacoes();
            }
        });

    } catch (erro) {
        console.error("Erro na leitura do catálogo: ", erro);
        // Opcional: mostrar um alerta para o usuário se o JSON falhar
    }
});