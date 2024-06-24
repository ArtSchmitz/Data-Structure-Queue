<?php

class Queue {

    private $count = 0;
    private $lowestCount = 0;
    private $items = [];

    public function addNaQueue(string $element) 
    {
        $this->items[$this->count] = $element;
        $this->count++;
    }

    public function isEmpty() 
    {
        return ($this->count - $this->lowestCount) === 0;
    }

    public function dequeue() 
    {
        if ($this->isEmpty()) return null;

        $result = $this->items[$this->lowestCount];
        unset($this->items[$this->lowestCount]);
        $this->lowestCount++;
        return $result;
    }

    public function peek() {
        if ($this->isEmpty()) return '';


        return $this->items[$this->lowestCount];
    }

    public function size() {
        return $this->count - $this->lowestCount;
    }

    public function clear() {
        $this->items = [];
        $this->count = 0;
        $this->lowestCount = 0;
    }

    public function toString() {
        if ($this->isEmpty()) return '';
        
        $objString = (string) $this->items[$this->lowestCount];

        for ($index = $this->lowestCount + 1; $index < $this->count; $index++) {
            $objString .= ', ' . (string) $this->items[$index];
        }
        return $objString;
    }
}

$queue = new Queue();

function displayMenu() {
    echo "Escolha uma opção:\n";
    echo "1. Adicionar à fila\n";
    echo "2. Remover da fila\n";
    echo "3. Ver o primeiro da fila\n";
    echo "4. Ver tamanho da fila\n";
    echo "5. Limpar a fila\n";
    echo "6. Verificar se a fila está vazia\n";
    echo "7. Mostrar todos os itens da fila\n";
    echo "0. Sair\n";
}

while (true) {
    displayMenu();
    $choice = trim(fgets(STDIN));

    switch ($choice) {
        case '1':
            echo "Digite o valor para adicionar à fila: ";
            $value = trim(fgets(STDIN));
            $queue->addNaQueue($value);
            echo "Valor adicionado!\n";
            break;
        case '2':
            $removed = $queue->dequeue();
            if ($removed === null) {
                echo "A fila está vazia, nada a remover.\n";
            } else {
                echo "Removido: $removed\n";
            }
            break;
        case '3':
            $peek = $queue->peek();
            if ($peek === '') {
                echo "A fila está vazia.\n";
            } else {
                echo "Primeiro da fila: $peek\n";
            }
            break;
        case '4':
            echo "Tamanho da fila: " . $queue->size() . "\n";
            break;
        case '5':
            $queue->clear();
            echo "Fila limpa!\n";
            break;
        case '6':
            echo $queue->isEmpty() ? "Sim, a fila está vazia.\n" : "Não, a fila não está vazia.\n";
            break;
        case '7':
            echo "Itens na fila: " . $queue->toString() . "\n";
            break;
        case '0':
            exit("Saindo...\n");
        default:
            echo "Opção inválida. Tente novamente.\n";
            break;
    }
}
