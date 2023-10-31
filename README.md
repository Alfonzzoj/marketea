Para ingresar Datos rapidamente utilizando tinker

## items

```bash
   use App\Models\Item;

   for ($i = 0; $i < 10; $i++) {
       $item = new Item;
       $item->name = 'Nombre del artículo ' . ($i + 1);
       $item->sku = 'SKU del artículo ' . ($i + 1);
       $item->price = rand(1, 100); // Precio aleatorio entre 1 y 100
       $item->save();
   }

```

## Customer

```bash
   use App\Models\Customer;

   for ($i = 0; $i < 10; $i++) {
       $customer = new Customer;
       $customer->name = 'Nombre del cliente ' . ($i + 1);
       $customer->email = 'email' . ($i + 1) . '@example.com';
       $customer->address = 'Dirección del cliente ' . ($i + 1);
       $customer->save();
   }

```

## Note

```bash
   use App\Models\Note;
   use App\Models\Customer;
   use Faker\Factory as Faker;

   $faker = Faker::create();

   $customers = Customer::all();

   for ($i = 0; $i < 10; $i++) {
       $note = new Note;
       $note->customer_id = $customers->random()->id;
       $note->date = $faker->date();
       $note->total = $faker->randomFloat(2, 10, 1000);
       $note->save();
   }


```

## NoteItem

```bash
   use App\Models\NoteItem;
   use App\Models\Note;
   use App\Models\Item;
   use Faker\Factory as Faker;

   $faker = Faker::create();

   $notes = Note::all();
   $items = Item::all();

   for ($i = 0; $i < 10; $i++) {
       $noteItem = new NoteItem;
       $noteItem->note_id = $notes->random()->id;
       $noteItem->item_id = $items->random()->id;
       $noteItem->quantity = $faker->numberBetween(1, 10);
       $noteItem->total = $faker->randomFloat(2, 10, 100);
       $noteItem->attach = $faker->text(50);
       $noteItem->save();
   }


```
