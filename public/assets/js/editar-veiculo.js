document.addEventListener('DOMContentLoaded', async function() {
    
    const selectModelo = document.querySelector('select[name="modelo"]');
    const selectVersao = document.querySelector('select[name="versao"]');
    
    const inputMotor = document.querySelector('input[name="motorizacao"]');
    const inputPotencia = document.querySelector('input[name="potencia"]');
    const inputAceleracao = document.querySelector('input[name="aceleracao"]');
    const inputTransmissao = document.querySelector('input[name="transmissao"]');
    const inputCombustivel = document.querySelector('select[name="combustivel"]'); // Note que na edição isso é um select!

    // 1. Captura o que veio do banco de dados via PHP
    const modeloSalvo = selectModelo.getAttribute('data-selecionado');
    const versaoSalva = selectVersao.getAttribute('data-selecionado');

    function limparEspecificacoes() {
        inputMotor.value = '';
        inputPotencia.value = '';
        inputAceleracao.value = '';
        inputTransmissao.value = '';
        inputCombustivel.value = '';
    }

    try {
        const resposta = await fetch('assets/json/catalog.json');
        if (!resposta.ok) throw new Error('Falha ao carregar o JSON');
        const catalogoBMW = await resposta.json();

        // 2. Preenche o select de Séries e pré-seleciona a do banco
        for (const serie in catalogoBMW) {
            const option = document.createElement('option');
            option.value = serie;
            option.textContent = serie;
            
            // Se for a série que veio do banco, marca como selecionada
            if (serie === modeloSalvo) {
                option.selected = true;
            }
            
            selectModelo.appendChild(option);
        }

        // 3. Como já existe uma série salva, já populamos as versões no load da página
        if (modeloSalvo && catalogoBMW[modeloSalvo]) {
            const versoes = catalogoBMW[modeloSalvo];
            
            for (const versao in versoes) {
                const option = document.createElement('option');
                option.value = versao;
                option.textContent = versao;
                
                // Se for a versão que veio do banco, marca como selecionada
                if (versao === versaoSalva) {
                    option.selected = true;
                }
                
                selectVersao.appendChild(option);
            }
        }

        // 4. Mantém a reatividade: se o usuário quiser TROCAR o carro durante a edição
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

        // 5. Preenche a ficha técnica apenas se o usuário trocar a versão manualmente
        // (Não fazemos isso no load porque a view do PHP já preencheu a ficha técnica original)
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
    }
});