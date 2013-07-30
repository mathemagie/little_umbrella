import pusher

p = pusher.Pusher(
  app_id='34650',
  key='b001467f86773130f94c',
  secret='0e41706b1a3e771927ab'
)

def close_parapluie():
	p['test_channel'].trigger('my_event')

def open_parapluie():
	p['test_channel'].trigger('my_event')

open_parapluie()