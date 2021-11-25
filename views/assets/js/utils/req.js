
  const req = async (url) => {
    const response = await fetch(`api/v1/${url}`)
    return await response.json()
}
