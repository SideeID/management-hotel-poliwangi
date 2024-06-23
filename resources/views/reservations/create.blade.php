<x-layout>
    <x-slot:title>{{ $title }}</x-slot:title>
    <section class="bg-white dark:bg-gray-900">
        <div class="bg-white border border-gray-200 rounded-lg shadow py-8 px-4 mx-auto max-w-2xl lg:py-16">
            <h2 class="mb-4 text-xl font-bold text-gray-900 dark:text-white">Add a New Reservation</h2>
            <form id="reservation-form" action="{{ route('reservations.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-2 sm:gap-6">
                    <div class="sm:col-span-2">
                        <label for="guest_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white form-control @error('guest_id') is-invalid @enderror">Guest Name</label>
                        <select id="guest_id" name="guest_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select a guest</option>
                            @foreach($guests as $guest)
                            <option value="{{ $guest->id }}">{{ $guest->name }}</option>
                            @endforeach
                        </select>
                        @error('guest_id')
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="w-full">
                        <label for="check_in" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Check-In</label>
                        <input type="date" name="check_in" id="check_in" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Select date" required>
                    </div>
                    <div class="w-full">
                        <label for="check_out" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Check-Out</label>
                        <input type="date" name="check_out" id="check_out" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Select date" required>
                    </div>

                    <div>
                        <label for="room_type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Booking Rooms</label>
                        <select id="room_type" name="rate_plan_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Select a room type</option>
                            @foreach($ratePlans as $ratePlan)
                            <option value="{{ $ratePlan->id }}">{{ $ratePlan->tipe_rooms }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Booking Date</label>
                        <input name="booking_date" id="booking-date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" required="">
                    </div>
                </div>
                <button type="submit" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-amber-500 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-700 hover:bg-amber-600">
                    Add Reservation
                </button>
            </form>
        </div>
    </section>

    <script>
        var bookingDateInput = document.getElementById('booking-date');
        function getCurrentDate() {
            var now = new Date();
            var year = now.getFullYear();
            var month = (now.getMonth() + 1).toString().padStart(2, '0');
            var day = now.getDate().toString().padStart(2, '0');
            return `${year}-${month}-${day}`;
        }
        bookingDateInput.value = getCurrentDate();
    </script>
</x-layout>
