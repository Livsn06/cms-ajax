<?php

namespace App\Helpers;

class ApiAIHelper
{
    public static function getApiAiResponse()
    {
        sleep(2);
        $response = self::apiData();
        $suggestion = collect($response)->random();
        return $suggestion;
    }

    private static function apiData()
    {
        return  [
            // --- 1. THE TRADITIONAL GIANTS ---
            [
                'name' => 'The Grand Manila Heritage',
                'description' => "APPETIZER:\n- Crispy Crablets with Vinegar Dip\n- Baked Tahong with Garlic & Cheese\n\nMAIN DISHES:\n- Slow-Cooked Beef Caldereta (Batangas Style)\n- Classic Chicken Pastel\n- Sweet & Sour Fish Fillet\n\nSIDES & RICE:\n- Pancit Guisado with Toppings\n- Steamed Pandan Rice\n\nDESSERT & DRINKS:\n- Leche Flan with Macapuno\n- Bottomless House-blend Iced Tea",
                'price' => 550.00,
            ],
            [
                'name' => 'Barrio Fiesta Boodle Premium',
                'description' => "STARTERS:\n- Ensaladang Mangga at Kamatis\n- Fried Lumpiang Shanghai\n\nFROM THE GRILL:\n- Inihaw na Liempo\n- Pork BBQ Skewers\n- Grilled Stuffed Squid\n\nVEGETABLES:\n- Ginisang Baguio Beans with Crispy Pork\n\nDESSERT:\n- Buko Pandan Salad\n- Fresh Tropical Fruit Platter\n\nBEVERAGE:\n- Cold Sago't Gulaman",
                'price' => 480.00,
            ],
            [
                'name' => 'Pampanga Culinary Pride',
                'description' => "APPETIZER:\n- Sizzling Pork Sisig (Authentic)\n- Tokwa't Baboy\n\nENTREES:\n- Kare-Kareng Baka with Homemade Bagoong\n- Chicken Adobo sa Gata\n- Beef Morcon\n\nSTARCH:\n- Bringhe (Kapampangan Paella)\n- Garlic Sinangag\n\nDESSERT:\n- Tibok-tibok (Carabao Milk Pudding)\n- Turon with Langka Skewers",
                'price' => 620.00,
            ],

            // --- 2. FOREIGN INFLUENCE (FILIPINO TASTE) ---
            [
                'name' => 'Modern Italian-Pinoy Feast',
                'description' => "STARTER:\n- Garlic Parmesan Chicken Wings\n- Bruschetta with Tomato & Basil\n\nPASTA STATION:\n- Creamy White Carbonara with Bacon Bits\n- Baked Macaroni (Extra Cheesy)\n\nMAIN COURSE:\n- Chicken Parmigiana\n- Pan-Seared Fish in Lemon Butter Sauce\n\nSIDE:\n- Herbed Butter Toast\n- Steamed Rice\n\nDESSERT & DRINKS:\n- Tiramisu Cups\n- Sparkling Raspberry Lemonade",
                'price' => 580.00,
            ],
            [
                'name' => 'Tokyo Night Buffet',
                'description' => "APPETIZER:\n- Shrimp and Vegetable Tempura\n- Kani Salad with Sesame Dressing\n\nMAIN DISHES:\n- Chicken Teriyaki\n- Beef Misono with Bean Sprouts\n- Tonkatsu (Pork Cutlet)\n\nSIDES:\n- Yakisoba Noodles\n- Miso Soup\n- Steamed Japanese Rice\n\nDESSERT:\n- Coffee Jelly with Cream\n- Green Tea / Matcha Mochi",
                'price' => 650.00,
            ],
            [
                'name' => 'Spanish Mestizo Celebration',
                'description' => "TAPAS:\n- Gambas al Ajillo\n- Calamares Encebollados\n\nMAIN DISHES:\n- Paella Valenciana (Seafood & Meat)\n- Lengua Estofado (Ox Tongue in Cream Sauce)\n- Roast Chicken with Rosemary\n\nSIDES:\n- Garden Salad with Vinaigrette\n- Warm Dinner Rolls\n\nDESSERT:\n- Canonigo with Custard Sauce\n- Freshly Brewed Barako Coffee",
                'price' => 850.00,
            ],
            [
                'name' => 'Seoul Food Party',
                'description' => "APPETIZER:\n- Korean Fried Chicken (Soy Garlic)\n- Mandu (Fried Dumplings)\n\nMAIN DISHES:\n- Beef Bulgogi\n- Spicy Pork Stir-fry\n- Chapchae (Glass Noodles)\n\nSIDES:\n- Unlimited Kimchi & Pickled Radish\n- Seaweed Soup\n\nDESSERT & DRINKS:\n- Korean Pear Slices\n- Strawberry Milk Drink",
                'price' => 495.00,
            ],

            // --- 3. THEMED & EVENT SPECIFIC ---
            [
                'name' => 'Executive Lunch Box Elite',
                'description' => "SALAD:\n- Potato Salad with Hard Boiled Egg\n\nMAIN DISHES:\n- Roast Beef with Mushroom Gravy\n- Buttered Vegetables (Corn, Carrots, Peas)\n- Steamed Jasmine Rice\n\nPASTRY:\n- Dark Chocolate Brownie\n\nBEVERAGE:\n- Canned Soda or Fruit Juice",
                'price' => 350.00,
            ],
            [
                'name' => 'Kiddie Adventure Package',
                'description' => "SNACKS:\n- Mini Hotdogs with Marshmallows\n- Cheese-flavored Popcorn\n\nMAIN DISHES:\n- Pinoy Style Sweet Spaghetti\n- Crispy Fried Chicken Drumsticks\n- Pork BBQ Sticks\n\nSIDES:\n- French Fries with Cheese Powder\n\nDESSERT:\n- Assorted Jelly Cups\n- Chocolate Cupcakes\n\nDRINK:\n- Orange Juice Fountain",
                'price' => 280.00,
            ],
            [
                'name' => 'Southern BBQ Backyard',
                'description' => "STARTER:\n- Cornbread Muffins with Honey Butter\n\nMAIN DISHES:\n- Hickory Smoked Baby Back Ribs\n- Southern Fried Chicken\n- Beef Sliders\n\nSIDES:\n- Macaroni and Cheese\n- Coleslaw\n\nDESSERT:\n- Peach Cobbler\n- Bottomless Lemonade",
                'price' => 720.00,
            ],

            // --- 4. REGIONAL SPECIALTIES ---
            [
                'name' => 'Ilocano Heritage Feast',
                'description' => "APPETIZER:\n- Vigan Longganisa Skewers\n- Empanada Bites\n\nMAIN DISHES:\n- Authentic Bagnet with KBL Dip\n- Pinakbet with Bagoong Isda\n- Igado (Pork Liver & Tenderloin)\n\nSIDES:\n- Poqui-Poqui (Eggplant & Egg)\n- Garlic Rice\n\nDESSERT:\n- Tupig (Grilled Rice Cake)\n- Fresh Calamansi Juice",
                'price' => 460.00,
            ],
            [
                'name' => 'Bicol Express Heat',
                'description' => "STARTER:\n- Dinailan (Shrimp Paste) Appetizer\n\nMAIN DISHES:\n- Special Bicol Express (Extra Creamy)\n- Laing with Tinapa Flakes\n- Grilled Liempo with Spiced Vinegar\n\nSIDES:\n- Fried Talong\n- Steamed Rice\n\nDESSERT:\n- Pili Nut Tart\n- Guyabano Juice",
                'price' => 390.00,
            ],
            [
                'name' => 'Visayan Island Grill',
                'description' => "STARTER:\n- Kinilaw na Tanigue\n\nMAIN DISHES:\n- Bacolod Chicken Inasal\n- Grilled Blue Marlin\n- Kansi (Beef Shank Soup)\n\nSIDES:\n- Ensaladang Talong\n- Java Rice with Annatto Oil\n\nDESSERT:\n- Mango Float\n- Fresh Coconut Water",
                'price' => 540.00,
            ],

            // --- 5. BUDGET FRIENDLY ---
            [
                'name' => 'Sulit Fiesta Saver',
                'description' => "MAIN DISHES:\n- Pork Menudo\n- Chicken Adobo\n- Mixed Vegetables\n\nSIDES:\n- Steamed White Rice\n- Fried Lumpiang Togue\n\nDESSERT:\n- Assorted Kakanin\n- Pineapple Juice",
                'price' => 250.00,
            ],
            [
                'name' => 'Student Party Bundle',
                'description' => "MAIN DISHES:\n- Creamy Pesto Pasta\n- Buffalo Chicken Wings\n- Potato Wedges\n\nDESSERT:\n- Fudge Brownies\n- Iced Tea Tower",
                'price' => 220.00,
            ],

            // --- 6. LUXURY & WEDDING ---
            [
                'name' => 'Royal Wedding Buffet',
                'description' => "SOUP & SALAD:\n- Creamy Mushroom Soup with Croutons\n- Caesar Salad with Bacon Bits\n\nAPPETIZER:\n- Smoked Salmon Blinis\n- Beef Carpaccio\n\nMAIN DISHES:\n- Roast Beef with Red Wine Reduction\n- Baked Salmon in Lemon Garlic Butter\n- Truffle Mushroom Pasta\n- Chicken Cordon Bleu\n\nSIDES:\n- Mashed Potatoes with Gravy\n- Asparagus with Parmesan\n\nDESSERT:\n- Mini Cheesecake Medley\n- Chocolate Fondue Station\n\nDRINKS:\n- Bottomless Cucumber Lime Water\n- Brewed Coffee & Tea",
                'price' => 1200.00,
            ],

            // --- 7. VEGETARIAN & HEALTHY ---
            [
                'name' => 'The Green Garden',
                'description' => "APPETIZER:\n- Fresh Vegetable Spring Rolls\n- Hummus with Celery & Carrots\n\nMAIN DISHES:\n- Tofu & Broccoli in Oyster Sauce\n- Vegetarian Lasagna (Spinach & Ricotta)\n- Cauliflower Steak with Chimichurri\n\nSTARCH:\n- Brown Rice / Quinoa\n\nDESSERT:\n- Fresh Fruit Skewers\n- Infused Detox Water",
                'price' => 450.00,
            ],

            // --- 8. MORE VARIATIONS ---
            [
                'name' => 'Midnight Snack Party',
                'description' => "BITES:\n- Mini Beef Sliders\n- Corn Dogs with Mustard\n- Nachos with Cheese & Salsa\n- Quesadillas\n\nBEVERAGE:\n- Assorted Soda & Fruit Shakes",
                'price' => 300.00,
            ],
            [
                'name' => 'Thai Orchid Banquet',
                'description' => "STARTER:\n- Thai Fish Cakes with Sweet Chili\n\nMAIN DISHES:\n- Pad Thai Noodles\n- Chicken Green Curry\n- Beef Basil Stir-fry\n\nSIDES:\n- Bagoong Rice\n- Tom Yum Soup (Small Cups)\n\nDESSERT:\n- Mango Sticky Rice\n- Thai Milk Tea",
                'price' => 520.00,
            ],
            [
                'name' => 'Chinese Dimsum Platter',
                'description' => "DIMSUM:\n- Pork Siomai\n- Hakaw (Shrimp Dumplings)\n- Chicken Feet in Taosi\n- Beancurd Rolls\n\nMAIN COURSE:\n- Yang Chow Fried Rice\n- Sweet and Sour Pork fillete\n\nDESSERT:\n- Buchi (Lotus Paste)\n- Jasmine Tea",
                'price' => 430.00,
            ],

            // --- 9. CONTINUING TO 50 (ABBREVIATED FOR PREVIEW) ---
            [
                'name' => 'Rustic Country Picnic',
                'description' => "COLD CUTS:\n- Ham & Salami Platter\n- Assorted Cheeses & Grapes\n\nMAIN:\n- Roast Chicken with Thyme\n- Slow-Roasted Pork Belly\n\nSIDES:\n- Corn on the Cob\n- Garden Salad\n\nDESSERT:\n- Apple Pie Squares\n- Fresh Lemonade",
                'price' => 590.00,
            ],
            [
                'name' => 'Ocean Feast Premium',
                'description' => "APPETIZER:\n- Baked Mussels in Butter\n- Fried Calamares Rings\n\nMAIN:\n- Steamed Lapu-Lapu in Ginger Soy\n- Chili Garlic Crabs\n- Garlic Butter Prawns\n\nSIDES:\n- Seaweed Salad (Lato)\n- Steamed Rice\n\nDESSERT:\n- Leche Flan\n- Fresh Buko Juice",
                'price' => 950.00,
            ],
            [
                'name' => 'American Diner Classic',
                'description' => "APPETIZER:\n- Buffalo Wings with Ranch\n- Mozzarella Sticks\n\nMAIN:\n- Double Cheeseburgers\n- Chili Cheese Dogs\n- Grilled Cheese Sandwiches\n\nSIDES:\n- Onion Rings\n- French Fries\n\nDRINK:\n- Vanilla & Chocolate Milkshakes",
                'price' => 480.00,
            ],
            [
                'name' => 'Middle Eastern Oasis',
                'description' => "STARTER:\n- Falafel with Tahini\n- Baba Ganoush & Pita Bread\n\nMAIN:\n- Lamb Kofta Skewers\n- Chicken Shawarma Platter\n- Beef Gyro\n\nSIDES:\n- Tabbouleh Salad\n- Turmeric Rice\n\nDESSERT:\n- Honey Baklava Medley\n- Mint Tea",
                'price' => 680.00,
            ],
            [
                'name' => 'French Bistro Dinner',
                'description' => "SOUP:\n- Onion Soup with Cheese Toast\n\nMAIN:\n- Coq au Vin (Chicken in Wine)\n- Beef Bourguignon\n- Ratatouille\n\nSIDES:\n- Baguette Slices\n- Mashed Potatoes\n\nDESSERT:\n- Creme Brulee\n- French Press Coffee",
                'price' => 880.00,
            ],
            [
                'name' => 'Vietnamese Zen',
                'description' => "STARTER:\n- Fresh Spring Rolls with Peanut Sauce\n\nMAIN:\n- Beef Pho (Noodle Soup)\n- Banh Mi Sliders\n- Shaking Beef (Bo Luc Lac)\n\nSIDES:\n- Vermicelli Noodle Salad\n\nDESSERT:\n- Mung Bean Cake\n- Vietnamese Iced Coffee",
                'price' => 420.00,
            ],
            [
                'name' => 'Mediterranean Sunset',
                'description' => "APPETIZER:\n- Hummus & Tatziki with Pita\n\nMAIN:\n- Lemon Herb Grilled Chicken\n- Beef Kebabs\n- Roasted Vegetable Couscous\n\nSIDES:\n- Greek Salad\n- Roasted Potatoes\n\nDESSERT:\n- Greek Yogurt with Honey\n- Cucumber Lemonade",
                'price' => 550.00,
            ],
            [
                'name' => 'Mexican Cantina',
                'description' => "STARTER:\n- Nachos with Guacamole & Salsa\n\nMAIN:\n- Beef and Chicken Fajitas\n- Cheese Enchiladas\n- Soft and Hard Tacos\n\nSIDES:\n- Mexican Street Corn (Elote)\n- Cilantro Lime Rice\n\nDESSERT:\n- Churros with Chocolate Dip\n- Horchata Drink",
                'price' => 470.00,
            ],
            [
                'name' => 'High Tea Elegance',
                'description' => "SAVORIES:\n- Cucumber & Cream Cheese Sandwiches\n- Smoked Salmon Blinis\n- Egg Salad Sliders\n\nSWEETS:\n- Scones with Clotted Cream & Jam\n- Assorted Macarons\n- Petit Fours\n\nDRINK:\n- Selection of English Teas",
                'price' => 520.00,
            ],
            [
                'name' => 'Oktoberfest Feast',
                'description' => "STARTER:\n- Soft Pretzels with Beer Cheese\n\nMAIN:\n- Grilled Bratwurst & Thuringer\n- Chicken Schnitzel\n- Pork Knuckle (Crispy Pata style)\n\nSIDES:\n- Sauerkraut\n- Potato Salad\n\nDESSERT:\n- Apple Strudel\n- Root Beer",
                'price' => 650.00,
            ],
            [
                'name' => 'Modern Asian Fusion',
                'description' => "APPETIZER:\n- Salted Egg Chicken Skins\n\nMAIN:\n- Thai Basil Beef\n- Laksa Pasta\n- Sambal Shrimp\n\nSIDES:\n- Nasi Goreng\n- Kangkong with Garlic\n\nDESSERT:\n- Thai Milk Tea Pudding\n- Lychee Juice",
                'price' => 510.00,
            ],
            [
                'name' => 'Filipino-Chinese Fusion',
                'description' => "APPETIZER:\n- Kiampong (Salty Rice)\n- Lumpiang Sariwa\n\nMAIN:\n- Beef Brocolli\n- Pata Tim (Braised Pork Leg)\n- Fish Fillet in Tausi Sauce\n\nSIDES:\n- Chopsuey\n- Yang Chow Fried Rice\n\nDESSERT:\n- Almond Jelly with Lychee\n- Hot Tea",
                'price' => 480.00,
            ],
            [
                'name' => 'Western Breakfast Buffet',
                'description' => "MAIN:\n- Fluffy Buttermilk Pancakes\n- Scrambled Eggs with Chives\n- Crispy Bacon Strips\n- Breakfast Sausage Links\n\nSIDES:\n- Hash Browns\n- Fresh Fruit Bowl\n\nBEVERAGE:\n- Fresh Orange Juice\n- Brewed Coffee",
                'price' => 380.00,
            ],
            [
                'name' => 'Pinoy Almusal Grand',
                'description' => "MAIN:\n- Beef Tapa (Cured Beef)\n- Spicy Tuyu in Olive Oil\n- Daing na Bangus\n- Vigan Longganisa\n\nSIDES:\n- Garlic Sinangag\n- Salted Egg with Tomato\n\nDESSERT:\n- Hot Pandesal with Palaman\n- Hot Tsokolate Eh!",
                'price' => 350.00,
            ],
            [
                'name' => 'Tuscany Farmhouse',
                'description' => "APPETIZER:\n- Fried Mozzarella Balls\n\nMAIN:\n- Chicken Cacciatore\n- Beef Tagliata\n- Vegetable Lasagna\n\nSIDES:\n- Polenta Fries\n- Caprese Salad\n\nDESSERT:\n- Panna Cotta\n- Italian Coffee",
                'price' => 750.00,
            ],
            [
                'name' => 'Hawaiian Luau',
                'description' => "STARTER:\n- Poke Bowls (Small portions)\n\nMAIN:\n- Kalua Pork (Shredded)\n- Huli-Huli Chicken\n- Coconut Crusted Shrimp\n\nSIDES:\n- Pineapple Fried Rice\n- Macaroni Salad\n\nDESSERT:\n- Haupia (Coconut Pudding)\n- Tropical Punch",
                'price' => 580.00,
            ],
            [
                'name' => 'Executive Coffee Break',
                'description' => "PASTRIES:\n- Mini Chicken Empanada\n- Ham and Cheese Croissants\n- Blueberry Muffins\n- Chocolate Chip Cookies\n\nBEVERAGE:\n- Selection of Coffee & Tea\n- Bottled Water",
                'price' => 250.00,
            ],
            [
                'name' => 'Steakhouse Premium',
                'description' => "SALAD:\n- Wedge Salad with Blue Cheese\n\nMAIN:\n- Ribeye Steak with Peppercorn Sauce\n- Grilled Salmon Steak\n\nSIDES:\n- Loaded Baked Potato\n- Creamed Spinach\n\nDESSERT:\n- New York Cheesecake\n- Red Wine (Mocktail)",
                'price' => 1500.00,
            ],
            [
                'name' => 'Lola’s Comfort Food',
                'description' => "SOUP:\n- Chicken Binakol (Coconut Water)\n\nMAIN:\n- Pork Adobo sa Gata\n- Fried Galunggong with Ensalada\n- Ginisang Monggo with Tinapa\n\nSIDES:\n- Steamed Rice\n- Banana Saba",
                'price' => 320.00,
            ],
            [
                'name' => 'Seafood Boil Party',
                'description' => "MAIN FEAST:\n- Mixed Seafood (Crabs, Shrimp, Mussels, Corn)\n- Cajun Spice Sauce\n- Fried Chicken Wings\n\nSIDES:\n- Steamed Rice\n- Sweet Corn on the Cob\n\nDESSERT:\n- Buko Salad\n- Lemonade Pitcher",
                'price' => 850.00,
            ],
            [
                'name' => 'Cocktail Grazing Table',
                'description' => "BITES:\n- Grazing Board (Cold cuts, Cheeses, Nuts)\n- Beef Salpicao Bits\n- Gambas Skewers\n- Cheese Puffs\n\nDRINK:\n- Assorted Mocktails & Soda",
                'price' => 600.00,
            ],
            [
                'name' => 'The Health Nut',
                'description' => "MAIN:\n- Grilled Salmon with Quinoa\n- Roasted Chicken Breast\n- Tofu Steaks\n\nSIDES:\n- Kale and Apple Salad\n- Sweet Potato Mash\n\nDESSERT:\n- Greek Yogurt with Berries\n- Fresh Green Juice",
                'price' => 550.00,
            ],
            [
                'name' => 'Indian Spice Route',
                'description' => "APPETIZER:\n- Vegetable Samosas\n\nMAIN:\n- Chicken Tikka Masala\n- Beef Rogan Josh\n- Palak Paneer (Spinach & Cheese)\n\nSIDES:\n- Biryani Rice\n- Naan Bread\n\nDESSERT:\n- Gulab Jamun\n- Mango Lassi",
                'price' => 590.00,
            ],
            [
                'name' => 'Brazilian Churrascaria',
                'description' => "MEATS:\n- Picanha (Sirloin) Strips\n- Garlic Butter Chicken Thighs\n- Sausage Grill\n\nSIDES:\n- Feijoada (Black Bean Stew)\n- Brazilian Rice\n- Fried Bananas\n\nDESSERT:\n- Grilled Pineapple with Cinnamon",
                'price' => 890.00,
            ],
            [
                'name' => 'Middle Eastern Mezze',
                'description' => "DIPS:\n- Hummus, Moutabal, Labneh\n- Pita Bread Basket\n\nMAIN:\n- Shish Taouk (Chicken)\n- Lamb Kebabs\n\nSIDES:\n- Fattoush Salad\n- Saffron Rice\n\nDESSERT:\n- Muhallebi (Milk Pudding)",
                'price' => 650.00,
            ],
            [
                'name' => 'Filipino merienda Buffet',
                'description' => "KITCHEN:\n- Arroz Caldo Station\n- Palabok Special\n- Tokwa't Baboy\n\nKAKANIN:\n- Puto Bumbong & Bibingka\n- Cassava Cake\n\nDRINK:\n- Gulaman with Gatas",
                'price' => 290.00,
            ],
            [
                'name' => 'Scandinavian Cold Buffet',
                'description' => "STARTER:\n- Gravlax (Cured Salmon)\n\nMAIN:\n- Swedish Meatballs with Lingonberry\n- Baked Cod with Dill\n\nSIDES:\n- Boiled Potatoes with Butter\n- Beetroot Salad\n\nDESSERT:\n- Swedish Apple Cake\n- Elderflower Juice",
                'price' => 780.00,
            ],
            [
                'name' => 'Classic Roast Dinner',
                'description' => "MAIN:\n- Roast Beef with Yorkshire Pudding\n- Roasted Whole Chicken\n\nSIDES:\n- Roasted Root Vegetables\n- Gravy & Mint Sauce\n- Mashed Potatoes\n\nDESSERT:\n- Sticky Toffee Pudding\n- English Tea",
                'price' => 680.00,
            ],
            [
                'name' => 'Tacos and Tequila (Mocktail)',
                'description' => "MAIN:\n- Al Pastor (Pork) Tacos\n- Barbacoa (Beef) Tacos\n- Fish Tacos\n\nSIDES:\n- Chips & Salsa\n- Mexican Slaw\n\nDESSERT:\n- Sopapillas with Honey\n- Margarita Mocktail",
                'price' => 450.00,
            ],
            [
                'name' => 'Grand Dimsum Lunch',
                'description' => "SELECTION:\n- Hakaw, Siomai, Shark's Fin (Simulated)\n- Spare Ribs in Taosi\n- Radish Cake\n- Taro Puffs\n\nSTARCH:\n- Lotus Leaf Sticky Rice\n\nDESSERT:\n- Mango Sago\n- Jasmine Tea",
                'price' => 550.00,
            ]
        ];
    }
}
