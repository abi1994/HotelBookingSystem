
                    <div class="card-header bg-primary text-white d-flex justify-content-center align-items-center">
                        <div class="text-center">
                            <h4>{{ __('Tickets') }}</h4>
                            <div class="profile-image-wrapper mt-2 mb-2">

                            </div>
                        </div>

                    </div>
                    <form action="{{ url('/create-ticket') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subject">Subject:</label>
                            <input type="text" name="subject" id="subject" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description:</label>
                            <textarea name="description" id="description" class="form-control" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Create Ticket</button>
                    </form>
                    @foreach($tickets as $ticket)
                        <div class="ticket">
                            <h3>{{ $ticket->subject }}</h3>
                            <p>{{ $ticket->description }}</p>
                            <p>Status: {{ $ticket->status }}</p>

                            @foreach($ticket->responses as $response)
                                <div class="response">
                                    <p>{{ $response->response }}</p>
                                    <p>By: {{ $response->user->name }}</p>
                                </div>
                            @endforeach

                            @if($ticket->status == 'open')
                                <form action="{{ url('/respond-ticket/' . $ticket->id) }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="response">Response:</label>
                                        <textarea name="response" id="response" class="form-control" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit Response</button>
                                </form>

                                <form action="{{ url('/close-ticket/' . $ticket->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger">Close Ticket</button>
                                </form>
                            @endif
                        </div>
                    @endforeach